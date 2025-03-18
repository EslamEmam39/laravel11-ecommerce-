<footer class="footer">
    <div class="container">
        <div class="row">
            @php($data = DB::table('general_settings')->first())
            <div class="col-lg-3 footer_col">
                <div class="footer_column footer_contact">
                    <div class="logo_container">
                        <div class="logo"><a href="#"><img src="{{ asset($data->logo) }}" alt="" style="width: 200px ;" ></a></div>
                    </div>
                    <div class="footer_title">{{ $data->email }}</div>
                    <div class="footer_phone">{{ $data->phone }}</div>
                    <div class="footer_contact_text">
                        <p>{{ $data->address }}</p>
                        
                    </div>
                    <div class="footer_social">
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fab fa-google"></i></a></li>
                            <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 offset-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Find it Fast</div>
                    @php($categories = DB::table('categories')->latest()->get())
              
                    <ul class="footer_list footer_list_2">
                        @foreach ($categories as $category)
                            <li><a href="#">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                 
                    <ul class="footer_list">
                        <li><a href="#">Car Electronics</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="footer_column">
                    @php($categories = DB::table('categories')->latest()->get())
                    <div class="footer_title">Category</div>

                    <ul class="footer_list footer_list_2">
                        @foreach ($categories as $category)
                            <li><a href="#">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="footer_column">
                    <div class="footer_title">Customer Care</div>
                    <ul class="footer_list">
                        <li><a href="{{ route('my.orders') }}">My Account</a></li>
                        <li><a href="{{ route('my.orders') }}">Order Tracking</a></li>
                        <li><a href="{{ route('favorite.view') }}">Wish List</a></li>
                        <li><a href="#">Customer Services</a></li>
                        <li><a href="#">Returns / Exchange</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Product Support</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</footer>