<?php
use App\Http\Controllers\AdminController;
$total = 0;
if (Session::has('user')) {
    $total = AdminController::cartItem();
}
// dd($products);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/home.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@1,300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('user/js/product.js') }}"></script> --}}
    <title>salma store</title>
</head>

<body>

    @include('user.navbar');
   {{-- <nav class="navbar bg-dark bg-body-tertiary fixed-top"> --}}
        <div class="container-fluid">
            <img  src="{{asset('images/logooo.jpg')}}" width="30px" height="24px" alt="">
            <a class="navbar-brand text-center text-light" href="#">Salma <span>store</span></a>
            {{-- <a class="navbar-brand text-center text-light" href="#"> Store</a> --}}
            {{-- <img class="navbar-brand logo" src=""  alt=""> --}}
            <button class="navbar-toggler text-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-light"></span>
            </button>
            <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header ">
                    <h5 class="offcanvas-title text-light" id="offcanvasNavbarLabel">Salma Store</h5>
                    <button type="button" class="btn-close text-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body"style=color>
                    <ul class="bg-dark navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <select class="form-select" onchange="location = this.value;">
                                <option value="{{ url('userProducts') }}">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ url('category/'.$category->id) }}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-light" aria-current="page" href="{{url('/')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('userProducts') }}">All Products</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('skirt') }}">skirt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('dress') }}">dress</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('swimmingWear') }}">swimming wear</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('blouses') }}">blouses</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('sales') }}">sales</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('sets') }}">sets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('cardigan') }}">cardigan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('abaya') }}">abaya</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('basic') }}">basic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('kimono') }}">kimono</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('tunic') }}">tunic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('scarfs') }}">scarfs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('bags') }}">bags</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link cartword text-light" href="{{ url('cartList') }}">Cart<span class="cartNumber">(
                                    {{ $total }} )</span></a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('orders') }}">orders</a>
                        </li>

                        @auth

                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ url('logout') }}">LogOut</a>
                            </li>
                        @endauth
                        @guest

                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ url('login') }}">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ url('login') }}">Login</a>
                            </li>
                        @endguest
                        <li class="nav-item">
                            <form class="d-flex selectC" action="{{url('convertCurrnecy')}}">
                                <select class="form-select" name="currnecy" id="currnecy">
                                    <option value="EGP"><a href="{{url('convertCurrnecy')}}">EGP</a></option>
                                    <option value="USD"><a href="{{url('convertCurrnecy')}}">USD</a></option>
                                    <option value="SAR"><a href="{{url('convertCurrnecy')}}">SAR</a></option>
                                  </select>
                                  <button class="btn bg-dark text-light">convert</button>
                            </form>
                        </li>

                    </ul>
                    <form class="d-flex mt-3" role="search" action="{{url('search')}}">
                        @csrf
                        <input class="form-control me-2" type="search" name="key" placeholder="Search" aria-label="Search">
                        <button class="search  btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav> 






    <div class="section home-section ">
        <div class="header ">
            <div class="layer">

                <div class="inner-header flex">
                    <!-- <h1 class="mt-3">Salma Store</h1> -->
                </div>
                <div>
                    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                        <defs>
                            <path id="gentle-wave"
                                d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                        </defs>
                        <g class="parallax">
                            <use xlink:href="#gentle-wave" x="48" y="0"
                                fill="rgba(255,255,255,0.7)" />
                            <use xlink:href="#gentle-wave" x="48" y="3"
                                fill="rgba(255,255,255,0.5)" />
                            <use xlink:href="#gentle-wave" x="48" y="5"
                                fill="rgba(255,255,255,0.3)" />
                            <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="best-selling flex-wrap">

            <h2 class="m-auto brand text-center mt-5 w-100">Best Sellings</h2>
                <hr class="mt-3 mb-5">
                 {{-- @foreach ($bestSellinges as $bestSelling)
                    <a class="cfff" href="{{url("productDetails/$bestSelling->id")}}"> <img src="{{ asset("storage/$bestSelling->image1") }}" alt="img" draggable="false"></a> --}}

                
{{--                     
        <div class="wrapper">
            <i id="left" class="fa-solid fa-angle-left"></i>
            <div class="carousel">
               <a class="cfff" href="{{url('productDetails/2')}}"> <img src="{{ asset('images/1-24494.jpg') }}" alt="img" draggable="false"></a>
               <a href="{{url('productDetails/9')}}"> <img src="{{ asset('images/1-24679.jpg') }}" alt="img" draggable="false"></a>
               <a href="{{url('productDetails/15')}}"> <img src="{{ asset('images/1-24795.jpg') }}" alt="img" draggable="false"></a>
               <a href="{{url('productDetails/12')}}"> <img src="{{ asset('images/1-24746.jpg') }}" alt="img" draggable="false"></a>
               <a href="{{url('productDetails/24')}}"> <img src="{{ asset('images/1-24758.jpg') }}" alt="img" draggable="false"></a>
               <a href="{{url('productDetails/11')}}"> <img src="{{ asset('images/1-24711.jpg') }}" alt="img" draggable="false"></a>
               <a href="{{url('productDetails/7')}}"> <img src="{{ asset('images/1-24564.jpg') }}" alt="img" draggable="false"></a>
            </div>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div> --}}
        {{-- @endforeach --}}

    {{-- </div> --}} 

    <div class="featured2">
        <div class="">
            <div class="featured pt-5  " id="all_products">
                <div class="container-fluid  mt-5 mb-5 pb-5">
                    <h2 class="m-auto brand text-center ">Best Selling</h2>
                    <hr class="mt-3 mb-5">
                    <div class="card-group">
                    </div>
                    <div class="d-flex flex-wrap justify-content-center">
                        @foreach ($bestSellinges->slice(0,4) as $product)
                            <div class="card ">
                                <img src="{{asset($product->image()->first()->filename)}}" alt="">
                                {{-- <img class="img2" src="{{asset($product->image()->first()->filename)}}" alt=""> --}}
                                @if ($product->image()->count() > 1)
                                    <!-- Display the second image if it exists -->
                                    <img class="img2" src="{{ asset($product->image()->skip(1)->first()->filename) }}" alt="">
                                @endif
                                <p class="category">{{$product->category->name}}</p>
                                <p class="product">{{ $product->name }}</p>
                                @if ($product->salePrice != null)
                                    <div class="btn btnsale  btn-success w-25 saleButton">SALE</div>
                                    <span class="price">{{ $product->salePrice }}</span>
                                @else
                                    <span class="price">{{ $product->price }}</span>
                                @endif
                                <span class="quantity">{{ $product->quantity }}</span>
                                {{-- @if ($product->quantity == 'in stock') --}}
                                    <button class="btn byebtn"> <a class='buy'
                                            href="{{ url("productDetails/$product->id") }}"> Buy Now </a></button>
                                {{-- @else --}}
                                    <button disabled class="btn"> <a class='buy'
                                            href="{{ url("productDetails/$product->id") }}"> Buy Now </a></button>
                                {{-- @endif --}}
                            </div>
                        @endforeach
                    </div>
                    <button class="btn btnsale btn-success mt-4 m-auto seeMore"> <a href="{{url('bestSelling')}}">See More</a></button>
                </div>
            </div>
        </div>
    </div>
        
    <div class="featured2">
        <div class="">
            <div class="featured pt-5  " id="all_products">
                <div class="container-fluid  mt-5 mb-5 pb-5">
                    <h2 class="m-auto brand text-center ">All Products</h2>
                    <hr class="mt-3 mb-5">
                    <div class="card-group">
                    </div>
                    <div class="d-flex flex-wrap justify-content-center">
                        @foreach ($products->slice(0,4) as $product)
                            <div class="card ">
                                <img src="{{asset($product->image()->first()->filename)}}" alt="">
                                {{-- <img class="img2" src="{{asset($product->image()->first()->filename)}}" alt=""> --}}
                                @if ($product->image()->count() > 1)
                                    <!-- Display the second image if it exists -->
                                    <img class="img2" src="{{ asset($product->image()->skip(1)->first()->filename) }}" alt="">
                                @endif
                                <p class="category">{{$product->category->name}}</p>
                                <p class="product">{{ $product->name }}</p>
                                @if ($product->salePrice != null)
                                    <div class="btn btnsale  btn-success w-25 saleButton">SALE</div>
                                    <span class="price">{{ $product->salePrice }}</span>
                                @else
                                    <span class="price">{{ $product->price }}</span>
                                @endif
                                <span class="quantity">{{ $product->quantity }}</span>
                                {{-- @if ($product->quantity == 'in stock') --}}
                                    <button class="btn byebtn"> <a class='buy'
                                            href="{{ url("productDetails/$product->id") }}"> Buy Now </a></button>
                                {{-- @else --}}
                                    <button disabled class="btn"> <a class='buy'
                                            href="{{ url("productDetails/$product->id") }}"> Buy Now </a></button>
                                {{-- @endif --}}
                            </div>
                        @endforeach
                    </div>
                    <button class="btn btnsale btn-success mt-4 m-auto seeMore"> <a href="{{url('userProducts')}}">See More</a></button>
                </div>
            </div>
        </div>
    </div>
    <div class="featured">
        <div class="">
            <div class="featured pt-5  " id="all_products">
                <div class="container-fluid  mt-5 mb-5 pb-5">
                    <h2 class="m-auto brand text-center text-light">ON SALE</h2>
                    <hr class="mt-3 mb-5">
                    <div class="card-group">
                    </div>
                    <div class="d-flex flex-wrap justify-content-center">
                        @foreach ($result as $resulto)
                            <div class="card ">
                                <img src="{{ asset($resulto->image()->first()->filename) }}" alt="">
                                @if ($product->image()->count() > 1)
                                    <!-- Display the second image if it exists -->
                                    <img class="img2" src="{{ asset($product->image()->skip(1)->first()->filename) }}" alt="">
                                @endif                                
                                <p class="category">{{ $resulto->category }}</p>
                                <p class="product">{{ $resulto->name }}</p>
                                @if ($resulto->salePrice != null)
                                    <div class="btn btnsale btn-success w-25 saleButton">SALE</div>
                                    <span class="price">{{ $resulto->salePrice }}</span>
                                @else
                                    <span class="price">{{ $resulto->price }}</span>
                                @endif
                                <span class="quantity">{{ $resulto->quantity }}</span>
                                @if ($resulto->quantity == 'in stock')
                                    <button class="btn byebtn"> <a class='buy'
                                            href="{{ url("productDetails/$resulto->id") }}"> Buy Now </a></button>
                                @else
                                    <button disabled class="btn"> <a class='buy'
                                            href="{{ url("productDetails/$resulto->id") }}"> Buy Now </a></button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <button class="btn btnsale btn-success mt-4 m-auto seeMore"> <a href="{{url('sales')}}">See More</a></button>

                </div>
            </div>
        </div>
    </div>


@include('user.footer')
    <script src="{{ asset('user/js/js.js') }}"></script>
    <script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    
  
</body>

</html>
