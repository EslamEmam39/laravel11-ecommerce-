 @extends('backend.master')

 @section('content')
     <!-- ########## START: RIGHT PANEL ########## -->
 
      <!-- ########## END: RIGHT PANEL ########## --->
  
      <!-- ########## START: MAIN PANEL ########## -->
      <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="{{ route('dashboard') }}">Dashboard</a>
          <span class="breadcrumb-item active">Dashboard</span>
        </nav>
  
        <div class="sl-pagebody">
  
          <div class="row row-sm">
            <div class="col-sm-6 col-xl-3">
              <div class="card pd-20 bg-primary">
                <div class="d-flex justify-content-between align-items-center mg-b-10">
                  <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Featured Product</h6>
                  <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                </div><!-- card-header -->
                <div class="d-flex align-items-center justify-content-between">
     
                  <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ $FeaturedProduct  }}</h3>
                </div><!-- card-body -->
                <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                </div>
                <!-- -->
              </div><!-- card -->
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
              <div class="card pd-20 bg-info">
                <div class="d-flex justify-content-between align-items-center mg-b-10">
                  <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Products</h6>
                  <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                </div><!-- card-header -->
                <div class="d-flex align-items-center justify-content-between">
         
                  <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$products}}</h3>
                </div><!-- card-body -->
                <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
            
                </div><!-- -->
              </div><!-- card -->
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
              <div class="card pd-20 bg-purple">
                <div class="d-flex justify-content-between align-items-center mg-b-10">
                  <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Categories</h6>
                  <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                </div><!-- card-header -->
                <div class="d-flex align-items-center justify-content-between">
                   
                  <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$category}}</h3>
                </div><!-- card-body -->
                <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                
               
                </div><!-- -->
              </div><!-- card -->
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
              <div class="card pd-20 bg-sl-primary">
                <div class="d-flex justify-content-between align-items-center mg-b-10">
                  <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Price Sale</h6>
                  <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                </div><!-- card-header -->
                <div class="d-flex align-items-center justify-content-between">
                  
                  <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{$order}}</h3>
                </div><!-- card-body -->
                <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
             
                </div><!-- -->
              </div><!-- card -->
            </div><!-- col-3 -->
          </div><!-- row -->
 
  
        </div><!-- sl-pagebody -->
    
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
 @endsection