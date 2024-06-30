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
    @include('user.navbar')
    <table class="table tableO mt-5 table-bordered table-responsive">
        <thead class="">
            <tr>
                <td scope="col">#</td>
                {{-- <td scope="col">First Name</td>
                <td scope="col">Last Name</td>
                <td scope="col">Phone Number</td>
                <td scope="col">Second Phone Number</td> --}}
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
                    {{-- <td>{{ $item->firstName }}</td>
                    <td>{{ $item->lastName }}</td>
                    <td>{{ $item->phoneNumber }}</td>
                    <td>{{ $item->secondPhoneNumber }}</td> --}}
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
