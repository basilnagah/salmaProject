<?php
use App\Http\Controllers\AdminController;
$total = 0;
if (Session::has('user')) {
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
    <link rel="stylesheet" href="{{ asset('user/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('user') }}css//media.css">
    <title>Document</title>
</head>

<body>

    <nav class="navbar bg-dark bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <img src="{{ asset('images/logooo.jpg') }}" width="30px" height="24px" alt="">
            <a class="navbar-brand text-center text-light" href="#">Salma <span>store</span></a>
            {{-- <a class="navbar-brand text-center text-light" href="#"> Store</a> --}}
            {{-- <img class="navbar-brand logo" src=""  alt=""> --}}
            <button class="navbar-toggler text-light" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-light"></span>
            </button>
            <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header ">
                    <h5 class="offcanvas-title text-light" id="offcanvasNavbarLabel">Salma Store</h5>
                    <button type="button" class="btn-close text-light" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body"style=color>
                    <ul class="bg-dark navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active text-light" aria-current="page"
                                href="{{ url('/') }}">Home</a>
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
                            <a class="nav-link cartword text-light" href="{{ url('cartList') }}">Cart<span
                                    class="cartNumber">(
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
                            <form class="d-flex selectC" action="{{ url('convertCurrnecy') }}">
                                <select class="form-select" name="currnecy" id="currnecy">
                                    <option value="EGP"><a href="{{ url('convertCurrnecy') }}">EGP</a></option>
                                    <option value="USD"><a href="{{ url('convertCurrnecy') }}">USD</a></option>
                                    <option value="SAR"><a href="{{ url('convertCurrnecy') }}">SAR</a></option>
                                </select>
                                <button class="btn bg-dark text-light">convert</button>
                            </form>
                        </li>

                    </ul>
                    <form class="d-flex mt-3" role="search" action="{{ url('search') }}">
                        @csrf
                        <input class="form-control me-2" type="search" name="key" placeholder="Search"
                            aria-label="Search">
                        <button class="search  btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <table class="table tableO mt-5 table-bordered table-responsive">
        <thead class="">
            <tr>
                <td scope="col">#</td>
                <td scope="col">First Name</td>
                <td scope="col">Last Name</td>
                <td scope="col">Phone Number</td>
                <td scope="col">Second Phone Number</td>
                <td scope="col">adress</td>
                <td scope="col">city</td>
                <td scope="col">status</td>
                <td scope="col">action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $item->firstName }}</td>
                    <td>{{ $item->lastName }}</td>
                    <td>{{ $item->phoneNumber }}</td>
                    <td>{{ $item->secondPhoneNumber }}</td>
                    <td>{{ $item->adress }}</td>
                    <td>{{ $item->city }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <form action="{{ url("deleteOrder/$item->id") }}">
                            <button class="btn  btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>


    <script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/js/product.js') }}"></script>
</body>

</html>
{{-- <main class="mt-5">
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
            {{ $item->firstName }}<br>
            {{ $item->lastName }}<br>
            {{ $item->phoneNumber }}<br>
            {{ $item->secondPhoneNumber }}<br>
            {{ $item->adress }}<br>
            {{ $item->city }}<br>
            {{ $item->status }}<br>
            <form action="{{ url("deleteOrder/$item->id") }}">
                <button class="btn  btn-danger">Delete</button>
            </form>
        @endforeach
    </div>

</main> --}}
