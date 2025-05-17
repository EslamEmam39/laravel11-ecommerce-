@extends('backend.master')

@section('title' , 'Add Product')

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{route('dashboard')}}">Dashboard</a>
      <a class="breadcrumb-item" href="{{route('product')}}">Products</a>
    
      <span class="breadcrumb-item active">Add Product</span>
    </nav>

    <div class="sl-pagebody">
 
      <div class="row row-sm mg-t-20">
        <div class="col-xl-12">
          <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
        
            <div class="row">
              <label class="col-sm-4 form-control-label">Category Product: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <select  id="category" class="form-control">  
                  <option value="" selected> select Product Category</option>
                    @foreach ( $categories as  $val)
                    <option value="{{$val->id}}" selected>{{$val->name}} </option>
                    @endforeach
                </select>
              </div>
 

            </div><!-- row -->
            <div class="row mg-t-20">
              <label class="col-sm-4 form-control-label">Product Name: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="text" id='productName' class="form-control" placeholder="Product Name">
              </div>
            </div>
            <div class="row mg-t-20">
              <label class="col-sm-4 form-control-label">Old Price: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="number" id="oldPrice" class="form-control" placeholder="Old Price">
              </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">New Price: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="number" id="newPrice" class="form-control" placeholder="New Price">
                </div>
              </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Description: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <textarea rows="6" id="des" class="form-control" placeholder="Product Description"></textarea>
                </div>
              </div>
           
            <div class="row mg-t-20">
              <label class="col-sm-4 form-control-label">Product Image: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="file" id='img' class="form-control" >
              </div>
            </div>
            <div class="form-layout-footer mg-t-30">
              <button class="btn btn-info mg-r-5 addPro">Add product</button>
         
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
        $('.addPro').click(function(e){

            let category = $('#category').val()
            let name = $('#productName').val()
            let oldPrice = $('#oldPrice').val()
            let newPrice = $('#newPrice').val()
            let des = $('#des').val()
            let img = $('#img').prop('files')[0]

            let formData = new FormData()
           formData.append('category' , category)
           formData.append('productName' , name)
           formData.append('oldPrice' , oldPrice)
           formData.append('newPrice' , newPrice)
           formData.append('des' , des)
           formData.append('img' , img)

         if(category == ''){

                Swal.fire({
                title: 'Error!',
                text: 'Plz Enter Product Category',
                icon: 'error',
                confirmButtonText: 'Ok'
                })

         } else if(name == ''){
                Swal.fire({
                title: 'Error!',
                text: 'Plz Enter Product name',
                icon: 'error',
                confirmButtonText: 'Ok'
                })
         }else if(newPrice == ''){
                Swal.fire({
                title: 'Error!',
                text: 'Plz Enter Price',
                icon: 'error',
                confirmButtonText: 'Ok'
                })
          }else if(img  == ''){
            Swal.fire({
                title: 'Error!',
                text: 'Plz Enter Product Image',
                icon: 'error',
                confirmButtonText: 'Ok'
                })
          }else{
          
            $.ajax({
                method : 'post',
                url : '/product-store',
                processData: false ,
                contentType:false,
                data :formData ,
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function (response){
                    if(response.data == 1){
                        Swal.fire({
                        title: 'Success',
                        text: 'Prodcut Added Successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                        }).then(() => {
                                location.reload(); // إعادة تحميل الصفحة  
                            });
                    }
                     
                }
            })
          }

        })
    })
</script>
@endsection