<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>{{ trans('message.allcategories')}}</span>
                    </div>
                    <ul>
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{$category->categories_name}}</a>
                                    <div class="dropdown-menu">
                                        @if(isset($categorieChilds))
                                            @foreach($categorieChilds as $categorieChild)
                                            <a href="#" class="dropdown-item">
                                                @if($category->id == $categorieChild->parent_id)
                                                    {{$categorieChild->categories_name}}
                                                @endif
                                            </a>
                                            @endforeach
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                {{ trans('message.allcategories')}}
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">{{ trans('message.search')}}</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>{{ trans('message.numberphone')}}</h5>
                            <span>{{ trans('message.timesp')}}</span>
                        </div>
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                    <div class="hero__text">
                        <span>{{ trans('message.fruit')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="hero">
    <div class="container">
        <div class="row pull-right">
            <div class="col-sm-12">
                <form class="form-inline" method="post" action="{{ route('check')}}">
                    @csrf
                    <div class="form-group">
                        <select name="r_rating" id="" class="form-control">
                            <option value="">Star</option>
                            <option value="">All</option>
                            <option value="1">1sao</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="r_categories"  class="form-control">
                            <option value="">Categories</option>
                            <option value="">All</option>
                            @if(isset($all_categories_product))
                                @php
                                    $no = 0;
                                @endphp
                                @foreach($all_categories_product as $all_categories_product)
                                    @php
                                        $no += 1;
                                    @endphp
                                    <option value="{{$all_categories_product->id}}" {{\Request::get('all_categories_product') == $all_categories_product->id ? 'selected' : ''}}>{{$no . ".  " . $all_categories_product->categories_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="r_price" id="" class="form-control">
                            <option value="">Price</option>
                            <option value="">All</option>
                            @if(isset($prices))
                                @php
                                    $no = 0;
                                @endphp
                                @foreach($prices as $price)
                                    @php
                                        $no += 1;
                                    @endphp
                                    <option value="{{$price->price}}" {{\Request::get('price') == $price->price ? 'selected' : ''}}>{{$no . ".  " . $price->price}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group ">
                        <input name="r_product_name" type="text" class="form-control"  value="{{\Request::get('product_name')}}" placeholder="Product name ...">
                    </div>
                    <button  type="submit" class="btn btn-info">CHECK</button>
                </form>
            </div>
        </div>
    </div>
</section>
