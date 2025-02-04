<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

     /**
     * Maintain created_at and updated_at automatically
     *
     * @var boolean
     */
    public $timestamps = true;

    /**
     * Maintain created_by and updated_by automatically
     *
     * @var boolean
     */
    public $userstamps = true;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'shipping_address',
        'billing_address',
        'payment_method'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
            ->withPivot('quantity', 'price');
    }

    public static function createOrders(int $userId, float $totalAmt, string $address, string $paymentMethod):mixed{
        return self::create([
            'user_id' => $userId,
            'total_amount' => $totalAmt,
            'shipping_address' => $address,
            'payment_method' => $paymentMethod,
            'status' => 'pending'
        ]);
    }

    public static function getOrdersWithProducts(int $id):mixed{
        return self::with('products')->findOrFail($id);
    }

    public static function getUserOrders($userId, $perPage = 10)
    {
        return self::with('products')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public static function getOrderWithProducts($orderId)
    {
        return self::with('products')->where('id', $orderId)->first();
    }

    public static function findOrFailOrder($id){
        return self::findOrFail($id);
    }
}