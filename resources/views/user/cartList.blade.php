<?php
use App\Http\Controllers\AdminController;
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
    <link rel="stylesheet" href="{{ asset('user/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('user') }}css//media.css">
    <title>Document</title>
</head>

<body>

 @include('user.navbar')

    <main class="mt-5">
        <div class="basket mt-5">
            <div class="basket-labels">
                <ul>
                    <li class="item item-heading">Item</li>
                    <li class="cprice">Price</li>
                    <li class="quantity">Quantity</li>
                    <li class="subtotal">Subtotal</li>
                </ul>
            </div>
            @foreach ($cart as $item)
                <div class="basket-product">
                    <div class="item">
                        <div class="product-image">
                            {{-- <img src="{{ asset("storage/$item->image1") }}" alt="Placholder Image 2" --}}
                            {{-- <img src="{{ asset($image->filename) }}" alt="Placholder Image 2" --}}
                            <img src="{{ asset($item->productVariant->color->media->where('color_id', $item->productVariant->color_id)->where('mediaable_id', $item->product_id)->first()->filename) }}" alt="Placholder Image 2"
                                class="product-frame">
                        </div>
                        <div class="product-details">
                            <h4><span class="item-quantity">{{ $item->quantity  }}</span> x {{ $item->product->name }}
                            </h4>
                            {{-- <h6><strong>{{ $item->size }}</strong></h6> --}}
                            <h6><strong>{{ $item->productVariant->size->name }}</strong></h6>
                            {{-- <p>Product Code - {{ $item->id }}</p> --}}
                        </div>
                    </div>
                    <div class="cprice"> {{ $item->product->price }}</div>
                    <div class="quantity"> {{ $item->quantity }}</div>
                    {{-- <div class="quantity">
                        <input type="number" value="1" min="1" class="quantity-field">
                    </div> --}}
                    <div class="subtotal">{{ $item->product->price * $item->quantity }}</div>
                    <div class="remove">
                        <a href="{{ url("removeCart/{$item->id}") }}" class="btn btn-danger bold">Remove</a>
                    </div>
                </div>

            @endforeach
        </div>
        <aside class="mt-5">
            <div class="summary mt-5">
                <div class="summary-total-items"><span class="total-items"></span> Items in your Bag</div>
                {{-- <div class="summary-subtotal">
                    <div class="subtotal-title">Subtotal</div>
                    <div class="subtotal-value final-value" id="basket-subtotal"></div> {{/* $result->Result*/}} --}}
                {{-- </div> --}}
                <div class="summary-total">
                    <div class="total-title">Total</div>
                    <div class="total-value final-value" id="basket-total">{{$totalPrice}}</div>  {{-- {{ /* $result->Result */}} --}}
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
