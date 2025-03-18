@extends('backend.master')

@section('title' , 'Edit Product')

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{route('dashboard')}}">Dashboard</a>
      <a class="breadcrumb-item" href="{{route('product')}}">Products</a>
      <span class="breadcrumb-item active">Edit Product</span>
    </nav>

    <div class="sl-pagebody">
 
 

      <div class="row row-sm mg-t-20">
        <div class="col-xl-12">
          <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
            <div class="row">
              <label class="col-sm-4 form-control-label">Product Name: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="text" id='name' class="form-control" value="{{$product->name}}">
              </div>
            </div><!-- row -->
            <div class="row mg-t-20">
              <label class="col-sm-4 form-control-label">Category Product: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <select  id="category" class="form-control">
                <option value="" selected> select Product Category</option>
                @foreach ($category as $val )
                <option value="{{$val->id}}" > {{$val->name}}</option>
                @endforeach
               </select>
              </div>
            </div>
            <div class="row mg-t-20">
              <label class="col-sm-4 form-control-label">Old Price: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                <input type="number" id="oldPrice"class="form-control" value="{{$product->old_price}}">
              </div>
            </div>
            <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">New Price: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <input type="number" id="newPrice" class="form-control"  value="{{$product->new_price}}">
                </div>
              </div>
              <div class="row mg-t-20">
                <label class="col-sm-4 form-control-label">Description: <span class="tx-danger">*</span></label>
                <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                  <textarea rows="6" id="des" class="form-control" placeholder="Product Description">{{$product->des}}</textarea>
                </div>
              </div>
            <div class="row mg-t-20">
              <label class="col-sm-4 form-control-label">Product Image: <span class="tx-danger">*</span></label>
              <div class="col-sm-8 mg-t-10 mg-sm-t-0">
               <input type="file" id="img" class="form-control">
              </div>
            </div>

            <input type="hidden" id="id" value="{{$product->id}}">

            <div class="form-layout-footer mg-t-30">
              <button class="btn btn-info mg-r-5 editPro" > Save </button>
      
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

    $('.editPro').click(function(e){
        let name      = $('#name').val();
        let category  = $('#category').val();
        let oldPrice  =$('#oldPrice').val();
        let newPrice  =$('#newPrice').val();
        let des       =$('#des').val();
        let id        = $('#id').val();

        let formData = new FormData() 
    
        if($('#img').prop('files')[0] != null){
            let img = $('#img').prop('files')[0];
             formData.append('img' , img) 
        }

        formData.append('name' , name)
        formData.append('category' ,category)
        formData.append('oldPrice' ,oldPrice)
        formData.append('newPrice',newPrice)
        formData.append('des',des)
        formData.append('id' ,id) 

       if(name == ''){
            Swal.fire({
            title: 'Error!',
            text: 'Plz Enter Product Name',
            icon: 'error',
            confirmButtonText: 'Ok'
            })
       }else if(category == ''){
        Swal.fire({
            title: 'Error!',
            text: 'Plz Enter Product Category',
            icon: 'error',
            confirmButtonText: 'Ok'
            })
       }else if(newPrice == ''){
        Swal.fire({
            title: 'Error!',
            text: 'Plz Enter New Price',
            icon: 'error',
            confirmButtonText: 'Ok'
            })
       }else{
        
        $.ajax({
            method : 'post',
            url : '/product-update',
            processData :false ,
            contentType : false ,
            data : formData ,
            headers : {
              
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            } ,
            success : function(response){
      
                 if(response.data == 1){
                    Swal.fire({
                    title: 'Success',
                    text: 'Product Updated Successfully',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                    }).then(() => {
                        location.reload(); 
                    });
                 }
            }
        })
       }

         
    })
})

</script>
@endsection