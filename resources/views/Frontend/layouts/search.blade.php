<div class="col-lg-5 col-sm-12 order-lg-2 order-sm-3 text-lg-left text-right">
    <div class="header_search">
        <div class="header_search_content">
            <div class="header_search_form_container">
                <form action="#" class="header_search_form clearfix">
                    <input type="search" class="header_search_input" placeholder="Search for products...">
                    <div class="custom_dropdown">
                        <div class="custom_dropdown_list">
                            <span class="custom_dropdown_placeholder clc"></span>
                            <ul class="custom_list clc">
                                <li ><a class="clc" href="#">All Categories</a></li>
                                    @foreach ($categories as $category)
                                    <li>
                                    <a class="clc" href="{{route( 'products.by.category',$category->id)}}">{{$category->name}}</a>
                                    </li>
                                    @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="submit" class="header_search_button trans_300" value="Submit">
                        <img src="{{asset('images/search.png')}}" alt="">
                    </button>
                </form>
                
            </div>
        </div>
    </div>
</div>

 
 