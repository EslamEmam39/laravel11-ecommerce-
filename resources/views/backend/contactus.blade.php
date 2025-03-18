@extends('backend.master')

@section('title','all message')

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
                <th>Phone</th>
                <th>message</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $val )
                    
          
              <tr>
             
                <td>{{$val->name}}</td>
                <td>{{$val->email}}</td>
                <td>{{$val->phone}}</td>
                <td>{{ mb_substr($val->message , 0, 10)  }} ....</td>
                <td  >
                    <a href="#"  data-toggle="modal" data-target="#modaldemo1{{ $val->id }}"class="btn btn-dark">  View message</a>
                    <a href="{{  route('contact.delete' , $val->id) }}"  class="btn btn-danger"> Delete  </a> 
                </td>
  
              </tr>

              <div id="modaldemo1{{ $val->id }}" class="modal fade">
                <div class="modal-dialog modal-dialog-vertical-center" role="document">
                  <div class="modal-content bd-0 tx-14">
                    <div class="modal-header pd-y-20 pd-x-25">
                      <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"  >Message Preview</h6>
                      <button type="button" class="close" data-dismiss="modal"  style="margin-left: 8rem;" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body pd-25">
               
                      <p class="mg-b-5">{{ $val->message }} </p>
                    </div>
                    <div class="modal-footer">
                   
                      <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div><!-- modal-dialog -->
              </div><!-- modal -->
              @endforeach
            </tbody>
          </table>
          {{ $data->links() }}
        </div>
      </div><!-- card -->

 

    </div><!-- sl-pagebody -->
 
  </div><!-- sl-mainpanel -->

@endsection