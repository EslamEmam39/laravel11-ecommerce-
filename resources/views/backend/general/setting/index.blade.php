@extends('backend.master')

@section('title' , 'Setting')


@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ route('dashboard') }}">Dashboard</a>
      <a class="breadcrumb-item">Setting</a>
      <span class="breadcrumb-item active">General</span>
    </nav>

    <div class="sl-pagebody">
      <div class="sl-page-title">
     
      </div><!-- sl-page-title -->

 
 

      <div class="card pd-20 pd-sm-40 mg-t-50">
      

        <div class="table-responsive">
          <table class="table table-hover table-bordered table-primary mg-b-0">
            <thead>
              <tr>
                
                <th>Name</th>
                <th>email</th>
                <th>phone</th>
                <th>address</th>
                <th>img</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
           
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->address}}</td>
                <td> 
                    <img src="{{asset($data->logo)}}" alt="">
                </td>
                <td>
                    <a href="{{ route('general.setting.edit') }}" class="btn btn-warning">Edit </a>
                </td>
              </tr>
          
            </tbody>
          </table>
        </div><!-- table-responsive -->

    
      </div><!-- card -->

      <p class="tx-11 tx-uppercase tx-spacing-2 mg-t-40 mg-b-10 tx-gray-600">Source Code</p>
 

    </div><!-- sl-pagebody -->
 
  </div><!-- sl-mainpanel -->
@endsection