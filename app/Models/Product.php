<?php

namespace App\Models;

use Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Product extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'quantity'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
            ->withPivot('quantity', 'price');
    }

    public static function findByEncryptedId($encryptedId)
    {
        try {
            // Decrypt the product ID
            $productId = Crypt::decryptString($encryptedId);
            // Find the product using the decrypted ID
            return self::findOrFail($productId);
        } catch (\Exception $e) {
            throw new ModelNotFoundException('Product not found.');
        }
    }

    public static function getAllProducts()
    {
        return self::all();
    }

    public static function search($search = null, $perPage = 10)
    {
        if (empty($search)) {
            return self::paginate($perPage); // Return paginated results
        } else {
            // Search for products with the given search term
            return self::where('name', 'like', "%$search%")->paginate($perPage); // Paginate results
        }
    }
}