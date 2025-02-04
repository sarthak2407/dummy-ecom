@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-shopping-cart"></i>
        </div>
        <div class="header-title">
            <h3>My Orders</h3>
        </div>
    </section>
    
    <div class="row grid-margin mt-3 mb-2">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="card">
                <div class="card-body">
                    @if($orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead class="thead-blue">
                                <tr>
                                    <th class="text-left">Order Id</th>
                                    <th class="text-left">Date</th>
                                    <th class="text-left">Status</th>
                                    <th class="text-right">Total</th>
                                    <th class="text-left">Product</th> <!-- New column for product -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $index => $order)
                                    <tr class="{{ $index % 2 == 0 ? 'bg-light' : 'bg-white' }}">
                                        <td class="text-left">{{ $order->id }}</td>
                                        <td class="text-left">{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="text-left">
                                            <span class="badge 
                                            @switch($order->status)
                                                @case('completed') badge-success @break
                                                @case('processing') badge-warning @break
                                                @case('cancelled') badge-danger @break
                                                @default badge-info
                                            @endswitch
                                        ">{{ ucfirst($order->status) }}</span>
                                        </td>
                                        <td class="text-right">${{ number_format($order->total_amount, 2) }}</td>
                                        <input type="hidden" id="product_id" value="{{$order->products}}">

                                        <td class="text-left">
                                            <a href="{{ route('product_show', ['order_id' => $order->id]) }}" class="btn btn-info btn-sm">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <p>Your cart is empty. <a href="{{ route('products.index') }}">Continue shopping</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Product Details -->
    {{-- <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="productDetails">
                    <!-- Product details will be loaded here dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}

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
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JS (ensure this matches your Bootstrap version) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Include Bootstrap 5 JS (no jQuery needed in Bootstrap 5) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>


{{-- <script>
    // Function to load product details dynamically into the modal
    function loadProductDetails(productId) {
        var get_product = "{{ URL::route('product_show') }}"
        // Assuming you have a route that returns product details in JSON format
        jQuery.ajax({
            url: get_product + productId,
            method: 'GET',
            success: function(response) {
                jQuery('#productDetails').html(`
                    <h5>${response.name}</h5>
                    <p>${response.description}</p>
                    <p><strong>Price:</strong> $${response.price}</p>
                    <p><strong>Category:</strong> ${response.category}</p>
                    <p><strong>Stock:</strong> ${response.stock}</p>
                `);
            },
            error: function() {
                jQuery('#productDetails').html('<p>Unable to load product details at this time.</p>');
            }
        });

    }
</script> --}}
@endsection
