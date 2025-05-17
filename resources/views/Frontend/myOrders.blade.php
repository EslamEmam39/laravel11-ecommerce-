@extends('Frontend.master')

@section('title' , 'My Orders')

@section('css')
<link rel="stylesheet" type="text/css" href="styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">
@endsection


@section('content')

<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="cart_container">
                    <div class="cart_title">   My Orders </div>
                    
                    <!-- Order Total -->
                    @foreach ($orders as $order)
                    @php($pro = is_string($order->product_id) ? json_decode($order->product_id, true) : [])
                    @php($quantity = is_string($order->quantity) ? json_decode($order->quantity, true) : [])
                
                    @for ($p = 0; $p < count($pro); $p++) 
                        @php($product = DB::table('products')->where('id' , '=', $pro[$p])->first())
                @if ($product)
                    
              
                        <div class="cart_items">
                            <ul class="cart_list">
                                <li class="cart_item clearfix">
                                    <div class="cart_item_image">
                                        <img src="{{ asset($product->img) }}" alt="">
                                    </div>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="cart_item_name cart_info_col">
                                            <div class="cart_item_title">Name</div>
                                            <div class="cart_item_text">{{ $product->name }}</div>
                                        </div>
                
                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Quantity</div>
                                            <div class="cart_item_text">{{ $quantity[$p] }}</div>
                                        </div>
                
                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Status</div>
                                        <div class="cart_item_text">     
                                        <button class="btn btn-sm change-status 
                                        {{ $order->status == 'completed' ? 'btn-success' : ($order->status == 'pending' ? 'btn-warning' : 'btn-danger') }}" >

                                        {{ ucfirst($order->status) }}
                                        </button></div>
                                        </div>
                
                                        <div class="cart_item_price cart_info_col">
                                            <div class="cart_item_title">Price</div>
                                            <div class="cart_item_text">
                                                {{ (float)$product->new_price * (int)$quantity[$p] }}
                                            </div>
                                        </div>
                
                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Date</div>
                                            <div class="cart_item_text">
                                                {{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        @endif
                    @endfor
                @endforeach
                <div class="d-flex justify-content-center mt-3">
                    {{ $orders->links('pagination::bootstrap-4') }}
                </div>
 
                </div>
            </div>
        </div>
    </div>
</div>
 
 
@endsection