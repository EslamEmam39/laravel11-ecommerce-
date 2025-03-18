@extends('backend.master')

@section('title' , 'Add Category')

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{route('dashboard')}}">Dashboard</a>
      <a class="breadcrumb-item" href="{{route('category')}}">Categories</a>
      <span class="breadcrumb-item active">Add Categories</span>
    </nav>

    <div class="sl-pagebody">
      <div class="row row-sm mg-t-20">
        <div class="col-xl-12">
          <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
            <h6 class="card-body-title">Add Category</h6>
   
            <div class="row">
              <label class="col-sm-4 form-control-label">Category Name: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="text" id="name" class="form-control" placeholder="Category Name">
              </div>
            </div><!-- row -->
            <div class="row mg-t-20">
              <label class="col-sm-4 form-control-label">Order: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="number" id="order" class="form-control" placeholder="Order">
              </div>
            </div>

            <div class="row mg-t-20">
              <label class="col-sm-4 form-control-label">Product Image: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="file" id='img' class="form-control" >
              </div>
            </div>
        
        
            <div class="form-layout-footer mg-t-30">
              <button class="btn btn-info mg-r-5 addCat">Save</button>
 
            </div><!-- form-layout-footer -->
          </div><!-- card -->
        </div><!-- col-6 -->
  
      </div><!-- row -->

    

    </div><!-- sl-pagebody -->
 
  </div><!-- sl-mainpanel -->
@endsection

@section('js')
<script>

    $(document).ready(function (){
     
        $('.addCat').click(function(e){
            e.preventDefault()

            let name = $('#name').val();
            let order = $('#order').val();
            let img = $('#img').prop('files')[0]

            let formData = new FormData()
           formData.append('name' , name)
           formData.append('order' , order)
           formData.append('img' , img)

            if(name == '' || !img){
                Swal.fire({
                title: 'Error!',
                text: 'plz Enter Category',
                icon: 'error',
                confirmButtonText: 'Ok'
                })
            }else{
                $.ajax({
                    method : 'post' ,
                    url : '/add-category/store',
                    processData: false ,
                    contentType:false,
                    data :formData ,
                    headers : {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function(response){
                      if(response.data == 0 ){
                        
                        Swal.fire({
                        title: 'Error!',
                        text: 'Category Already Exists',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                        })
        
                      }else{
                        Swal.fire({
                        title: 'success!',
                        text: 'Category Added Successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                        })
                      }
                    }

                })
            }
        })
 

    })
</script>
@endsection