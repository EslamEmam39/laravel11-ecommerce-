@extends('Frontend.master')

@section('title' , 'Wishlist Product')

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
               <div class="cart_title">Wishlist Product</div><br><br>
              
                 
                     @if ($data->count() == 0 )
                     <span class="cart_title text-danger">Wishlist Product is Empty</span>
                     @else
                     @foreach ( $data as  $val)
                     <div class="cart_items ">
                         <ul class="cart_list">
                             <li class="cart_item clearfix">
                                 <div class="cart_item_image"><img src="{{asset($val->img)}}" alt=""></div>
                                 <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between align-text-center">
                                     <div class="cart_item_name cart_info_col">
                                         <div class="cart_item_title">Name</div>
                                         <div class="cart_item_text">{{$val->name}}</div>
                                     </div>
                               
                              
                                     <div class="cart_item_price cart_info_col">
                                         <div class="cart_item_title">Price</div>
                                         <div class="cart_item_text">{{$val->new_price}}EG</div>
                                     </div>
                                     <div class="cart_item_total cart_info_col">
                                         <div class="cart_item_title">Delete</div>
                                         <div class="cart_item_text"><button productID='{{$val->id}}' class="btn btn-dark cartBtn">Add To Cart</button></div>
                                     </div>
                                     <div class="cart_item_total cart_info_col">
                                         <div class="cart_item_title">Delete</div>
                                         <div class="cart_item_text"><button productID='{{$val->id}}' class="btn btn-danger delproductFav">Delete</button></div>
                                     </div>
                                     
                                 </div>
                             </li>
                         </ul>
                     </div>
                     @endforeach
                     @endif
                
              
                {{$data->links()}}
              
                </div>
     
            </div>
        </div>

    </div>
</div>
@endsection


@section('js')
 <script>
    $(document).ready(function(){

        $('.delproductFav').click(function(e){
            e.preventDefault();
         let product = $(this).attr('productID')

            Swal.fire({
           title: 'Are you sure?',
           text: "You won't be able to Delete!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#d33', 
           cancelButtonColor: '#3085d6',
           confirmButtonText: 'Yes, delete it!'
         }).then((result)=> {

            if(result.isConfirmed){

              $.ajax({

                method : 'get' ,
                url :  '/delete-favorite/'+product+'' ,

                success : function(response){
                    if (response.data == 1) {
                        window.location.reload(); 
                        } 
                }

              })
            }
         })

        })

        $('.cartBtn').click(function(e){
            e.preventDefault();

             let cartId    = $(this).attr('productID')
       
                    $.ajax({
                    method: 'get' ,
                    url : '/favorite/add-cart/'+cartId+'' ,
                        success : function(response){
                            if(response.data == 1){
                                Swal.fire({
                                title: 'Confirm!',
                                text: 'The Product Add to Cart Successfully',
                                icon: 'warning',
                                confirmButtonText: 'Ok'
                                }).then((result)=>{
                                    if(result.isConfirmed){
                                        window.location.reload();
                                    }
                                })
                                 
                            }else{
                                Swal.fire({
                                title: 'Error!',
                                text: 'The Product Alrady Existe Cart ',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                                })
                            }
                            
                        }
                         })
                
             
     

         
        })
    })
 </script>
@endsection