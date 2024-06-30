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
        <thead>
            <tr>
              <th scope="col">#</th>
              {{-- <th scope="col">name</th> --}}
              {{-- <th scope="col">Phone number</th> --}}
              {{-- <th scope="col">Phone number 2</th> --}}
              <th scope="col">image</th>
              <th scope="col">Prodduct Name</th>
              <th scope="col">Product Size</th>
              <th scope="col">Product color</th>
              <th scope="col">Order Status</th>
              <th scope="col">Address</th>
              <th scope="col">Phone Number</th>
              <th scope="col">Second Phone Number</th>
              <th scope="col">options</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($orderItems as $item )
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
              <td><img src="{{ asset($item->product->image->where('color_id', $item->product_variant->color_id)->first()->filename) }}" alt="Placholder Image 2"
                class="product-frame"></td>
              <td>{{$item->product->name}}</td>
              <td>{{$item->product_variant->size->name}}</td>
              <td>{{$item->product_variant->color->name}}</td>
              <td>{{$item->order->status}}</td>
              <td>{{$item->order->adress}}</td>
              <td>{{$item->order->user->phoneNumber}}</td>
              <td>{{$item->order->user->secondPhoneNumber}}</td>
              <td>
                  <h1>
                      {{-- <a class="btn btn-success" href="{{url("editOrder/$order->id")}}" >edit</a> --}}
                  </h1>
              </td>
              <td>
                  <h1>
                      {{-- <a class="btn btn-primary" href="{{url("viewOrder/$order->id")}}" >view</a> --}}
                  </h1>
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
