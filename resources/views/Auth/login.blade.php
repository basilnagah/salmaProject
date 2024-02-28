@extends('Auth.layout')


@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Webleb</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
            integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('user/css/login.css') }}">
    </head>

    <body>
        <div class="form">
            @if (session()->has('message'))
                <p class="alert alert-danger w-50 m-auto mb-5">
                    {{ session()->get('message') }}
                </p>
            @endif
            <ul class="tab-group">
                <li class="tab active"><a href="#signup" style="border-radius: 15px!important;margin-right:8x;">Sign Up</a>
                </li>
                <li class="tab"><a href="#login" style="border-radius: 15px!important;margin-left:8px;">Log In</a></li>
            </ul>
            <div class="tab-content">

                <div id="signup">
                    <h1>Register</h1>
                    <form action="{{ url('register') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="w-100 alert alert-danger"> {{ $error }} </div>
                            @endforeach
                        @endif


                        <div class="field-wrap">
                            <input type="text" name="name" required placeholder="First Name" />
                        </div>
                        <div class="field-wrap">
                            <input type="email" name="email" required placeholder="Email Address" />
                        </div>
                        <div class="field-wrap">
                            <input type="password" name="password" required placeholder="Password" />
                        </div>
                        <div class="field-wrap">
                            <input type="password" name="password_confirmation" required placeholder="Password" />
                        </div>
                        <button type="submit" class="button button-block">Sign Up</button>
                    </form>
                </div>
                <div id="login">
                    <h1>Welcome Back!</h1>
                    <form action="{{ url('login') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger"> {{ $error }} </div>
                            @endforeach
                        @endif
                        <div class="field-wrap">
                            <input type="email" name="email" required placeholder="Email" />
                        </div>
                        <div class="field-wrap">
                            <input type="password" name="password"required placeholder="Password" />
                        </div>
                        <button class="button button-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('user/js/login.js') }}"></script>
    </body>

    </html>

@endsection
