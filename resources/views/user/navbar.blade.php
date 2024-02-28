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
