<?php
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Session;
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
    <link rel="stylesheet" href="{{ asset('user/css/chechk.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/media.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <title>salma store</title>
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


    <div class="container checkoutpg mt-5"> <br><br><br>
        <h1 class="check">CHECK OUT</h1>
        <br><br>
        <div class="row">
            <div class=" col-lg-6 col-md-7 col-sm-12 persnonal">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger"> {{ $error }} </div>
                    @endforeach
                @endif
                <h2>Personal information</h2>
                <hr>
                <form action="{{ url('order') }}" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <div class="col-md-6">

                        <input type="text" name="firstName" class="form-control" id="validationCustom01"
                            placeholder="First Name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="lastName" class="form-control" id="validationCustom02"
                            placeholder="Last Name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group has-validation">
                            <input type="number" name="phoneNumber" class="form-control"
                                id="validationCustomUsername" placeholder="Phone Number"
                                aria-describedby="inputGroupPrepend" required>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group has-validation">
                            <input type="number" name="secondPhoneNumber" class="form-control"
                                id="validationCustomUsername" placeholder="second Phone Number"
                                aria-describedby="inputGroupPrepend" required>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="country" class="form-control" id="validationCustom03"
                            placeholder="Country" required>
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="city" id="validationCustom04" required>
                            <option selected disabled value="">city</option>
                            <option>القاهرة</option>
                            <option>الاسكندرية</option>
                            <option>أسوان</option>
                            <option>أسيوط</option>
                            <option>البحيرة</option>
                            <option>بنى سويف</option>
                            <option>الدقهلية</option>
                            <option>دمياط</option>
                            <option>الفيوم</option>
                            <option>الغربية</option>
                            <option>الجيزة</option>
                            <option>الاسماعيلية</option>
                            <option>كفر الشيخ</option>
                            <option>الاقصر</option>
                            <option>مطروح</option>
                            <option>المنيا</option>
                            <option>المنوفية</option>
                            <option>الوادى الجديد</option>
                            <option>شمال سيناء</option>
                            <option>بورسعيد</option>
                            <option>القليوبية</option>
                            <option>البحر الاحمر</option>
                            <option>الشرقية</option>
                            <option>سوهاج</option>
                            <option>جنوب سيناء </option>
                            <option>السويس</option>
                            <option>قنا</option>


                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
                    <div class="input-group">

                        <textarea name="adress" class="form-control" aria-label="With textarea" placeholder="Detailed Address"></textarea>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                required>
                            <label class="form-check-label" for="invalidCheck">
                                Agree to terms and conditions
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div>
                    <button class="orderButton btn btn-success">Place Order</button>
                </form>
            </div>
            <div class=" col-lg-6 col-md-7 col-sm-12 mb-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <h2>Products</h2>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td> <img src="{{ asset("storage/$product->image1") }}" alt=""
                                        class="item-img">
                                    <span id="Product-name"> {{ $product->name }} {{ 'x' }}
                                        {{ $product->quantity }}</span>
                                </td>
                                <td></td>
                                <td>{{ $product->price * $product->quantity }} </td>
                                <td></td>
                            </tr>
                        @endforeach



                        <tr>
                            <td>
                                <h3>Total</h3>
                            </td>
                            <td></td>
                            <td><span>{{ $result->Result }}</span></td>
                            <td>+ مصاريف الشحن</td>

                        </tr>

                    </tbody>
                </table>
            </div>
            <img class="del mt-5" src="{{ asset('images/delll.jpeg') }}" alt="">

        </div>
    </div>

    {{-- <img src="{{asset('images/erg.jpg')}}" alt=""> --}}

</body>
<script src="js/js.js"></script>
<script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>

</html>
