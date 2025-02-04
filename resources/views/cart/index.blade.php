@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-shopping-cart"></i>
        </div>
        <div class="header-title">
            <h3>Your Shopping Cart</h3>
        </div>
    </section>
    
    <div class="row grid-margin mt-3 mb-2">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="card">
                <div class="card-body">
                    @if(count($cart['products']) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead class="thead-blue">
                                <tr>
                                    <th class="text-left">Product</th>
                                    <th class="text-left">Price</th>
                                    <th class="text-left">Quantity</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalPrice = 0; @endphp
                                @foreach($cart['products'] as $index => $item)
                                    <tr class="{{ $index % 2 == 0 ? 'bg-light' : 'bg-white' }}">
                                        <td class="text-left">{{ $item['name'] }}</td>
                                        <td class="text-left">${{ number_format($item['price'], 2) }}</td>
                                        <td class="text-left">{{ $item['pivot']['quantity'] }}</td>
                                        <td class="text-right">${{ number_format($item['price'] * $item['pivot']['quantity'], 2) }}</td>
                                    </tr>
                                    @php $totalPrice += $item['price'] * $item['pivot']['quantity']; @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                    <td class="text-right"><strong>${{ number_format($totalPrice, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @else
                        <p>Your cart is empty. <a href="{{ route('products.index') }}">Continue shopping</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .table th, .table td {
            vertical-align: middle;
            padding: 15px;
            border: 1px solid #dee2e6; /* Add border to table cells */
        }
        .table-hover tbody tr:hover {
            background-color: #f5f5f5; /* Highlight row on hover */
        }
        .thead-blue th {
            background-color: #007bff; /* Blue background for the header */
            color: white; /* White text color for the header */
        }
        .bg-light {
            background-color: #f8f9fa; /* Light background for even rows */
        }
        .bg-white {
            background-color: #ffffff; /* White background for odd rows */
        }
        .text-left {
            text-align: left; /* Align text to the left */
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header-title h3 {
            font-weight: bold;
        }
    </style>
</div>
@endsection