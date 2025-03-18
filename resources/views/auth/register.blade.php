 @extends('auth.master')
 @section('title','register')
 @section('content')
 
 <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-md-100v">

    <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white">
      <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">New Acount <span class="tx-info tx-normal">User</span></div>
     <br><br>

      <div class="form-group">
        <input type="text" class="form-control" placeholder="Enter your Name" id="name">
      </div><!-- form-group -->
      <div class="form-group">
        <input type="email" class="form-control" placeholder="Enter your Email" id="email">
      </div><!-- form-group -->
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Enter your password" id="password">
      </div><!-- form-group -->
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Enter your  repassword" id='repassword'>
      </div><!-- form-group -->
       <button type="submit" class="btn btn-info btn-block newAcount">Sign Up</button>

      <div class="mg-t-40 tx-center">Already have an account? <a href="{{route('login')}}" class="tx-info">Sign In</a></div>
    </div><!-- login-wrapper -->
  </div><!-- d-flex -->
 @endsection

 @section('js')
<script>
   $(document).ready(function(){

    $('.newAcount').click(function(e){
      e.preventDefault();

 

      let name        = $('#name').val() 
      let email       = $('#email').val()
      let password    = $('#password').val()
      let repassword = $('#repassword').val()

 
      if(name == ''){

        Swal.fire({
        title: 'Error!',
        text: 'plz Enter name',
        icon: 'error',   
        confirmButtonText: 'Cool'
            })

      }else if(email == ''){

        Swal.fire({
        title: 'Error!',
        text: 'plz Enter Email',
        icon: 'error',
        confirmButtonText: 'Cool'
            })

      }else if(password == ''){

        Swal.fire({
        title: 'Error!',
        text: 'plz Enter Password',
        icon: 'error',
        confirmButtonText: 'Cool'
            })

      }else if(repassword == ''){

        Swal.fire({
        title: 'Error!',
        text: 'plz Enter Repassword',
        icon: 'error',
        confirmButtonText: 'Cool'
            })

      }else if(password != repassword){

        Swal.fire({
        title: 'Error!',
        text: 'Password is Not Match',
        icon: 'error',
        confirmButtonText: 'Cool'
            })

      }else{

    $.ajax({

    method :'post',
    url : '/new-account',
    data :{

      name : name,
      email :email,
      password : password 
    },

    headers : {

      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
   
    success : function(response){
    if(response.data == 0){

      Swal.fire({
        title: 'Error!',
        text: 'Email Already Exist',
        icon: 'error',
        confirmButtonText: 'Cool'
            })

    }else{

     window.location.href = "/"

    }
    
    }
       
 
  })
        }

 
    })  
 })
</script>

 
 @endsection
 