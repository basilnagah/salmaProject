<?php
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Session;
$total=0;
if(Session::has('user')){

    $total = AdminController::cartItem();
}
?>
<!DOCTYPE html>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('user') }}css/all.min.css">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('user') }}css//media.css">
    <title>Document</title>
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

    <main class="mt-5">
        <div class="basket">
            <div class="basket-labels">
                <ul>
                    <li class="item item-heading">Item</li>
                    <li class="cprice">Price</li>
                    <li class="quantity">Quantity</li>
                    <li class="subtotal">Subtotal</li>
                </ul>
            </div>
            @foreach ($products as $item)
                <div class="basket-product">
                    <div class="item">
                        <div class="product-image">
                            <img src="{{ asset("storage/$item->image1") }}" alt="Placholder Image 2"
                                class="product-frame">
                        </div>
                        <div class="product-details">
                            <h4><span class="item-quantity">{{ $item->quantity }}</span> x {{ $item->name }}
                            </h4>
                            <h6><strong>{{ $item->size }}</strong></h6>
                            <p>Product Code - {{ $item->id }}</p>
                        </div>
                    </div>
                    <div class="cprice"> {{ round($item->price / $currencies) }}  {{ $currenciesWord }}</div>
                    <div class="quantity"> {{ $item->quantity }}</div>
                    {{-- <div class="quantity">
                        <input type="number" value="1" min="1" class="quantity-field">
                    </div> --}}
                    <div class="subtotal">{{round( $item->price * $item->quantity / $currencies)}} {{ $currenciesWord }}</div>
                    <div class="remove">
                        <a href="{{ url("removeCart/{$item->id}") }}" class="btn btn-danger bold">Remove</a>
                    </div>
                </div>

            @endforeach
        </div>
        <aside class="mt-5">
            <div class="summary">
                <div class="summary-total-items"><span class="total-items"></span> Items in your Bag</div>
                <div class="summary-subtotal">
                    <div class="subtotal-title">Subtotal</div>
                    <div class="subtotal-value final-value" id="basket-subtotal">{{ round($result->Result / $currencies)}}  {{ $currenciesWord }}</div>
                </div>
                <div class="summary-subtotal">
                    <div class="subtotal-title">delivery</div>
                    <div class="subtotal-value final-value" id="basket-subtotal"> 1.5 {{ $currenciesWord }}</div>
                </div>
                <div class="summary-total">
                    <div class="total-title">Total</div>
                    <div class="total-value final-value" id="basket-total"> {{ 1.5 +round($result->Result / $currencies)}} {{ $currenciesWord }}</div>
                </div>
                <div class="summary-checkout">
                    <form action="{{url('chechkOut')}}">
                        <button class="checkout-cta">Proceed To Checkout</button>
                    </form>
                </div>
            </div>
        </aside>
    </main>


    <script src="{{asset('user/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('user/js/product.js')}}"></script>
</body>

</html>
