@extends('backend.master')

@section('title' , 'Edit Profile')


@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{route('dashboard')}}">Dashboard</a>
 
      <span class="breadcrumb-item active">Edit Profile</span>
    </nav>

    <div class="sl-pagebody">
      <div class="sl-page-title">
        
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <div class="form-layout">
          <div class="row mg-b-25">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" id="name" value="{{Auth::user()->name}}" placeholder="Enter name">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                <input class="form-control" type="email" id="email" value="{{Auth::user()->email}}" placeholder="Enter Email">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">Password: <span class="tx-danger">*</span></label>
                <input class="form-control" type="password" id="password" >
              </div>
            </div><!-- col-4 -->
          </div><!-- row -->

          <div class="form-layout-footer">
            <button class="btn btn-info mg-r-5 btnUpdateProfile">Save</button>
            
          </div><!-- form-layout-footer -->
        </div><!-- form-layout -->
      </div><!-- card -->
    </div><!-- sl-pagebody -->
 
  </div><!-- sl-mainpanel -->
@endsection


@section('js')

<script>

$(document).ready(function(){

    $('.btnUpdateProfile').click(function(e){

        e.preventDefault();

         let name      = $('#name').val();
         let email     = $('#email').val();
         let password  = $('#password').val();

         if(name == ''){

                Swal.fire({
                title: 'Error!',
                text: 'Please enter your name',
                icon: 'error',
                confirmButtonText: 'Cool'
                })
         }else if(email == ''){
            Swal.fire({
                title: 'Error!',
                text: 'Please enter your email',
                icon: 'error',
                confirmButtonText: 'Cool'
                })
         }else{

            $.ajax({
                method: 'post', 
                url:'/admin-profile/edit' ,
                data:{
                    email :email ,
                    name :name ,
                    password : password
                },
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                   if(response.data == 1){
                        Swal.fire({
                        title: 'Done!',
                        text: 'Profile Updated Success',
                        icon: 'success',
                        confirmButtonText: 'ok'
                        }).then((result)=>{
                            if(result.isConfirmed){
                                window.location.reload();
                            }
                        })
                   } 
                }
            })
         }
    });
});


</script>

@endsection