@extends('backend.master')

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{route('dashboard')}}">Dashboard</a>
 
      <span class="breadcrumb-item active">Categories</span>
    </nav>

    <div class="sl-pagebody">
    
      <div class="card pd-20 pd-sm-40">
     
        <div class="table-responsive">
          <table class="table table-hover table-bordered table-primary mg-b-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Order</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
          @foreach ($data as $val )
             <tr>  
                <td>{{$val->id}}</td>
                <td>{{$val->name}}</td>
                <td> 
                <a href="{{asset($val->img)}} " target="_blank"><img src="{{asset($val->img)}}" alt="" style="width: 100px"></a> 
                </td>
                <td>{{$val->order}}</td>
                <td>
                    <a href="{{route('category.edit' , $val->id)}}" class="btn btn-primary btn-block mg-b-10">Edit</a>
                    <button class="btn btn-danger btn-block mg-b-10 btnDele" catID={{$val->id}}>Delete</button>
                </td>
              </tr>
          @endforeach   
            </tbody>
          </table>
        </div><!-- table-responsive -->
      </div><!-- card -->
    </div><!-- sl-pagebody -->
  </div><!-- sl-mainpanel -->

  {{-- {{$data->link()}} --}}
@endsection

@section('js')
<script>
$(document).ready(function(){

    $('.btnDele').click(function(e){
   

    let id = $(this).attr('catID')

  
    Swal.fire({
           title: 'Are you sure?',
           text: "You won't be able to revert this!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#d33', 
           cancelButtonColor: '#3085d6',
           confirmButtonText: 'Yes, delete it!'
         }).then((result) => {

        if(result.isConfirmed){

          $.ajax({
            method : 'post',
            url : '/category/delete',

            data: {
              id : id 
            } ,
            headers : {
 
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(response){
              if (response.data == 1) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Product has been deleted.',
                                icon: 'success'
                            }).then(() => {
                                location.reload(); 
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong. Please try again!',
                                icon: 'error'
                            });
                        }
            }
          })
        }
      })
 

    })

})

</script>
@endsection