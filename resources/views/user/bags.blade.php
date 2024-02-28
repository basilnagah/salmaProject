<?php
use App\Http\Controllers\AdminController;
$total = 0;
if (Session::has('user')) {
    $total = AdminController::cartItem();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/media.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet">
    <script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>
    <title>salma store</title>
</head>

<body>

    <nav class="navbar bg-dark bg-body-tertiary fixed-top">
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
                            <a class="nav-link active text-light" aria-current="page" href="{{url('/')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('userProducts') }}">All Products</a>
                        </li>
                        <li class="nav-item">
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
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('sales') }}">sales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('sets') }}">sets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('cardigan') }}">cardigan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('abaya') }}">abaya</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ url('orders') }}">orders</a>
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
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cartword text-light" href="{{ url('cartList') }}">Cart<span class="cartNumber">(
                                    {{ $total }} )</span></a>

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

    <div class="section_all_products" id="all_products">
        <div class="container-fluid">
            <div class="all_products pt-5 mt-3 " id="all_products">
                <div class="container-fluid  mt-5 mb-5 pb-5">
                    <h2 class="m-auto brand text-center">Bags</h2>
                    <hr class="mt-3 mb-5">
                    <div class="card-group">
                    </div>
                    @if (session()->has('addedToCart'))
                        <p class="alert alert-success w-50 m-auto mb-4">
                            {{ session()->get('addedToCart') }}
                        </p>
                    @endif
                    <div class="d-flex flex-wrap justify-content-center">



                        @foreach ($products as $product)
                            <div class="card">
                                <img src="{{ asset("storage/$product->image1") }}" alt="">
                                <img class="img2" src="{{ asset("storage/$product->image2") }}" alt="">
                                <p class="category">{{ $product->category }}</p>
                                <p class="product">{{ $product->name }}</p>
                                <span class="price">{{ $product->price }}</span><span
                                    class="quantity">{{ $product->quantity }}</span>
                                <button class="btn byebtn"> <a class='buy'
                                        href="{{ url("productDetails/$product->id") }}"> Buy Now </a></button>
                            </div>
                        @endforeach




                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <footer class="site-footer">
            <hr>
            <div class="container">
                <div class="d-flex justify-content-center">
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <p class="copyright-text">Copyright &copy; 2017 All Rights Reserved
                        </p>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <ul class=" social-icons">
                            <a class="facebook" href="https://www.facebook.com/salmastore2023?mibextid=ZbWKwL"
                                target="_blank"><i class="fa-brands fa-facebook fa-beat-fade fa-lg ms-2 me-2"
                                    style="color: #1877F2;"></i></a>
                            <a class="instagram" href="https://instagram.com/salmastore7?igshid=MTI1ZDU5ODQ3Yw=="
                                target="_blank"><i class="fa-brands fa-instagram fa-beat-fade fa-lg ms-2 me-2"
                                    style="color: #E4405F;"></i></a>
                            <a class="telegram" href="https://t.me/salmastore81" target="_blank"><i
                                    class="fa-brands fa-telegram fa-beat-fade fa-lg ms-2 me-2"
                                    style="color: #0088cc;"></i></a>
                            <i class="fa-brands fa-whatsapp fa-beat-fade fa-lg ms-2 me-2 d-inline"
                                style="color: #49c173;">
                                <P class="d-inline">+201050883058</P>
                            </i>

                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>


</body>

</html>
