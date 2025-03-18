@extends('Frontend.master')

@section('title', 'Carts')

@section('css')
<link rel="stylesheet" type="text/css" href="styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">

@endsection

@section('content')
	<!-- Cart -->

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					@if (session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
				@endif
					@if ($data->count() == 0)
					<div class="cart_title text-danger">Shopping Cart is Empty</div>
					@else
					<div class="cart_container">
						<div class="cart_title">Shopping Cart</div>
						 
                        @foreach ($data as $val )
                            	<div class="cart_items">
							<ul class="cart_list">
								<li class="cart_item clearfix">
									<div class="cart_item_image"><img src="{{asset($val->img)}}" alt=""></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Name</div>
											<div class="cart_item_text" id="name">{{$val->name}}</div>
										</div>
								 
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Quantity</div>
											<div class="cart_item_text" id="quantity">{{$val->quantity}}</div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Price</div>
											<div class="cart_item_text" id="new_price">{{$val->new_price}}EG</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Total</div>
											<div class="cart_item_text" id="">{{$val->new_price * $val->quantity}}</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Delete</div>
											<div class="cart_item_text"><button class="btn btn-danger deleteCartProduct" productID="{{$val->id}}">Delete</button></div>
										</div>
									</div>
								</li>
							</ul>
						</div>
                        @endforeach
					
						
						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Order Total:</div>
								<div class="order_total_amount">{{ $all }}</div>
							</div>
						</div>

						<div class="cart_buttons">
							<button type="button" class="button cart_button_clear" >Empty to Cart</button>
							<a href="{{ route('checkout.details') }}" class="button cart_button_checkout">Check out</a>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
						<div class="newsletter_title_container">
							<div class="newsletter_icon"><img src="images/send.png" alt=""></div>
							<div class="newsletter_title">Sign up for Newsletter</div>
							<div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
						</div>
						<div class="newsletter_content clearfix">
							<form action="#" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
								<button class="newsletter_button">Subscribe</button>
							</form>
							<div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')

<script>

$(document).ready(function(){

	$('.deleteCartProduct').click(function(e){

		e.preventDefault();

		let productID = $(this).attr('productID') 
   
		Swal.fire({
           title: 'Are you sure?',
           text: "You won't be able to revert this!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#d33', 
           cancelButtonColor: '#3085d6',
           confirmButtonText: 'Yes, delete it!'

         }).then((result)=>{
			if(result.isConfirmed){
				 
				$.ajax({
					method : 'get' ,
					url :'/cart-delete/'+ productID +'' ,
					success : function(response){
						if (response.data == 1) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Product has been deleted.',
                                icon: 'success'
                            }).then((result) => {
								if(result.isConfirmed){
									 window.location.reload(); 
								}
                             
                            });
                        } 
						 
					}
				})

			}
		 })
	});




	$('.cart_button_clear').click(function(e){

		e.preventDefault();
      
		Swal.fire({
           title: 'Are you sure?',
           text: "You won't be able to Cart Empty!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#d33', 
           cancelButtonColor: '#3085d6',
           confirmButtonText: 'Yes, delete it!'
         }).then((result)=>{
			if(result.isConfirmed){
				$.ajax({
					method: 'get' , 
					url : '/empty-cart' ,
					success: function(response){
						window.location.reload();
					}
				})
			}
		 })


	});
 
	$('.header_search_button').click(function(e){

e.preventDefault();

 let btnSearch  = $('.header_search_input').val();

 if( btnSearch == ''){

	Swal.fire({
	title: 'Error!',
	text: 'Please enter a product name',
	icon: 'error',
	confirmButtonText: 'Ok'
	})

 }else{
	$.ajax({
		method : 'post',
		url : '/search-product',
		data :{
			'search' : btnSearch 
		} ,
		headers:{
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}, 
		success: function(response) {
			if(response.data == 0){
				Swal.fire({
				title: 'Error!',
				text: 'Product Not Fount',
				icon: 'error',
				confirmButtonText: 'Ok'
				})
				// console.log(response);
			}
			else{
				window.location.href = '/search-result/'+ btnSearch + ''
			}

		}
	})
 }
})
 
});



 

</script>
	
@endsection