@extends('Frontend.master')

@section('title' , ' Contact Us')

@section('css')
<link rel="stylesheet" type="text/css" href="styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
@endsection


@section('content')


<div class="contact_info">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="images/contact_1.png" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Phone</div>
                            <div class="contact_info_text">{{$data->phone}}</div>
                        </div>
                    </div>

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="images/contact_2.png" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Email</div>
                            <div class="contact_info_text">{{$data->email}}</div>
                        </div>
                    </div>

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="images/contact_3.png" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Address</div>
                            <div class="contact_info_text">{{$data->address}}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

 
    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="contact_form_container">
                        <div class="contact_form_title">Get in Touch</div>
                           @if (Session::has('msg'))
                                <p style="color: red; font-size: 22px;text-align:center;">{{Session::get('msg')}}</p>
                           @endif
                        <form action="{{ route('contact.update') }}" method="POST" id="contact_form">
                            @csrf
                            <div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
                                <div style="width: 80%">
                                         <input type="text" style="width: 80% ;color: #000;" name="name" class="contact_form_name input_field" placeholder="Your name">
                                @error('name')
                                 <span class="text-danger" style="display: block;"> {{ $message }}</span>   
                                @enderror
                                </div>
                                <div style="width: 80%">
                                    <input type="text" style="width: 80% ;color: #000;" name="email" class="contact_form_email input_field" placeholder="Your email">
                                    @error('email')
                                    <span class="text-danger" style="display: block;"> {{ $message }}</span>   
                                   @enderror
                                </div>
                                 <div style="width: 80%">
                                    <input type="number" style="width: 80%;color: #000;" name="phone" class="contact_form_phone input_field" placeholder="Your phone number">
                                    @error('phone')
                                    <span class="text-danger" style="display: block;"> {{ $message }}</span>   
                                   @enderror
                                 </div>
                             </div>
                            <div class="contact_form_text">
                                <textarea id="contact_form_message" style="color: #000;" class="text_field contact_form_message" name="message" rows="4" placeholder="Message" ></textarea>
                                @error('message')
                                <span class="text-danger" style="display: block;"> {{ $message }}</span>   
                               @enderror
                            </div> 
                            <div class="contact_form_button">
                                <button type="submit" class="button contact_submit_button">Send Message</button>
                            </div>
                        </form>
    
                    </div>
                </div>
            </div>
        </div>
        <div class="panel"></div>
    </div>
 
@endsection