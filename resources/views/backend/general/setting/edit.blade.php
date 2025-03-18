@extends('backend.master')


@section('title' , 'Edit')

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ route('dashboard') }}">Dashboard</a>
      <a class="breadcrumb-item" href="{{ route('general.setting') }}">Setting</a>
      <span class="breadcrumb-item active">Setting Edit</span>
    </nav>

    <div class="sl-pagebody">
      <div class="sl-page-title">
     
      </div><!-- sl-page-title -->


      <div class="row row-sm mg-t-20">
        <div class="col-xl-12">
          <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
          
            <div class="row">
              <label class="col-sm-4 form-control-label">Name: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="text" id="name" class="form-control" value="{{ $data->name }}" placeholder="Site Name">
              </div>
            </div><!-- row -->
            <div class="row mg-t-20">
              <label class="col-sm-4 form-control-label">Email: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="text" id="email" class="form-control" value="{{ $data->email }}" placeholder="Site Email">
              </div>
            </div>
            <div class="row mg-t-20">
              <label class="col-sm-4 form-control-label">Phone: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="text" id="phone" class="form-control" value="{{ $data->phone }}" placeholder="Site phone">
              </div>
            </div>
            <div class="row mg-t-20">
              <label class="col-sm-4 form-control-label">Address: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <textarea rows="2" id="address" class="form-control" placeholder="Site address"> {{$data->address}}</textarea>
              </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">logo: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="file" id="logo" class="form-control" placeholder="Enter your address"> 
                </div>
              </div>
            <div class="form-layout-footer mg-t-30">
              <button class="btn btn-info mg-r-5 updateBtn">Save</button>
        
            </div><!-- form-layout-footer -->
          </div><!-- card -->
        </div><!-- col-6 -->
       
      </div><!-- row -->
    </div><!-- sl-pagebody -->
    
  </div><!-- sl-mainpanel -->
@endsection

@section('js')

<script>

    $(document).ready(function(){
        $('.updateBtn').click(function(e){

            e.preventDefault();

            let name     = $('#name').val();
            let email    = $('#email').val();
            let phone    = $('#phone').val();
            let address  = $('#address').val();
            let logo     = $('#logo').prop('files')[0]
           


            let formData = new FormData()
           formData.append('name' , name)
           formData.append('email' , email)
           formData.append('phone' , phone)
           formData.append('address' , address)
           formData.append('logo' , logo)
           
           $.ajax({
                    method : 'post' ,
                    url : '/setting-general/update',
                    processData: false ,
                    contentType:false,
                    data :formData ,
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function(response){
                     if(response.data == 1){
                        window.location.reload();
                     }
                    }

                })
        });
    });
</script>
    
@endsection