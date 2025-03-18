@extends('backend.master')

@section('title' , 'View Featured-Products')

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{route('dashboard')}}">Dashboard</a>
  
      <span class="breadcrumb-item active">Featured Products</span>
    </nav>
  
    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <div class="table-responsive">
          <table class="table mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Old Price</th>
                <th>New Price</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ( $products as $product )
                <tr>
             @php($category = DB::table('categories')->where('id','=' ,$product->category)->first())
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$product->old_price}}</td>
                    <td>{{$product->new_price}}</td>
                    <td>
                  <a href="{{asset($product->img)}}"  target="_blank"><img src="{{asset($product->img)}}"  style="width: 75px;" alt=""></a> 
                    </td>
                    <td>
                        <a href="{{route('featured.product.edit' ,$product->id)}}" class="btn btn-outline-primary btn-block mg-b-10">Edit</a>
                        <button class=" deletePro btn btn-outline-danger btn-block mg-b-10" data-id="{{ $product->id }}">Delete</button>
                        
                    </td>
              </tr>
                @endforeach
            
      
            </tbody>
          </table>
          {{ $products->links() }}
        </div>
      </div><!-- card -->
    </div><!-- sl-pagebody -->
    
  </div><!-- sl-mainpanel -->
@endsection


@section('js')
<script>
$(document).ready(function () {

 $('.deletePro').click(function (e) {

   e.preventDefault();

   let productId = $(this).data('id'); 

   Swal.fire({
           title: 'Are you sure?',
           text: "You won't be able to revert this!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#d33', 
           cancelButtonColor: '#3085d6',
           confirmButtonText: 'Yes, delete it!'
         }).then((result)=> {

           if(result.isConfirmed){
           $.ajax({
                method: 'POST',
                url: '/featured-product-delete',
                data: {
                    id: productId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                        if (response.data == 1) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Product has been deleted.',
                                icon: 'success'
                            }).then(() => {
                                location.reload(); // إعادة تحميل الصفحة بعد الحذف
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong. Please try again!',
                                icon: 'error'
                            });
                        }
                    },
           })
           }
         })

 });
});

</script>
@endsection