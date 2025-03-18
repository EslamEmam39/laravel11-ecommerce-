@extends('Frontend.master')

@section('title' , 'Products-Category')

@section('css')
 <link rel="stylesheet" type="text/css" href="{{asset('styles/shop_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('styles/shop_responsive.css')}}">
@endsection

@section('content')
<!-- Home -->

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{asset('images/shop_background.jpg')}}"></div>
    <div class="home_overlay"></div>
    <div class="home_content d-flex flex-column align-items-center justify-content-center">
        <h2 class="home_title">{{$selctCat->name}}</h2>
    </div>
</div>

<!-- Shop -->

<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">

                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">Categories</div>
                        <ul class="sidebar_categories">
                            @foreach ($category as $val)
                                <li><a href="{{route('products.by.category',['id' => $val->id])}}">{{$val->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                
                <!-- Shop Content -->

                <div class="shop_content">
          

                    <div class="product_grid">
                        <div class="product_grid_border"></div>
        
                            @foreach ($product as $val )
                        <!-- Product Item -->
                        <div class="product_item">
                            <div class="product_border"></div>
                            <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                <img src="{{asset($val->img)}}" alt=""></div>
                            <div class="product_content">
                                <div class="product_price">{{$val->new_price}}EGP 
                                    <span style="color: red ; text-decoration: line-through;">{{$val->old_price}}EGP</span>
                                </div>
                                <div class="product_name"><div><a href="{{route('products.view',$val->id)}}" tabindex="0">{{$val->name}}</a> </div></div>
                            </div>
                            <div class="product_fav"><i class="fas fa-heart"></i></div>
                            <ul class="product_marks">
                    
                            </ul>
                        </div>
                              @endforeach

                    </div>

                    <!-- Shop Page Navigation -->
                {{$product->links()}}

                </div>

            </div>
        </div>
    </div>
</div>

 


@endsection