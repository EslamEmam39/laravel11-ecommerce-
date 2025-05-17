@extends('backend.master')

@section('title' , 'Users')

@section('content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ route('dashboard') }}">Dashboard</a>
 
      <span class="breadcrumb-item active">All Messages</span>
    </nav>

    <div class="sl-pagebody">
      <div class="sl-page-title">
   
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
    @if (Session::has('msg'))
    <p style="color: red; font-size: 22px;text-align:center;">{{Session::get('msg')}}</p>
    @endif

        <div class="table-responsive">
          <table class="table mg-b-0">
            <thead>
              <tr>
           
                <th>Name</th>
                <th>Email</th>
                <th>Created_at</th>      
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $val )
                    
          
              <tr>
             
                <td>{{$val->name}}</td>
                <td>{{$val->email}}</td>
                <td>{{\Carbon\Carbon::parse($val->created_at)->diffForHumans()}}</td>
            
                <td  >
                    {{-- <a href="#"  data-toggle="modal" data-target="#modaldemo1{{ $val->id }}"class="btn btn-dark">  View message</a> --}}
                    <a href="{{  route('admin.users.delete' , $val->id) }}"  class="btn btn-danger"> Delete  </a> 
                </td>
  
              </tr>

              
              @endforeach
            </tbody>
          </table>
          {{ $data->links() }}
        </div>
      </div><!-- card -->

 

    </div><!-- sl-pagebody -->
 
  </div><!-- sl-mainpanel -->

@endsection