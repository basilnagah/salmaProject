<?php
use App\Http\Controllers\AdminController;
use App\Models\color;

$total=0;
if(Session::has('user')){

    $total = AdminController::cartItem();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user') }}css/all.min.css">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('user') }}css//media.css">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet"> -->
    <!-- <link  href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"> -->
    <script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('user/js/product.js') }}"></script>
    <title>salma store</title>

    <style>
        .size-box {
            border: 1px solid #ccc;
            padding: 10px;
            cursor: pointer;
            display: inline-block;
            margin-right: 10px;
        }

        .color-input {
            width: 100px; /* Adjust the width according to your preference */
            margin-bottom: 10px; /* Add space between each input */
            /* You can add more styling as needed */
        }
        .color-button{
            /* border: none;
            color: white;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            border-radius: 50%; */
            border: 2px solid black; /* Set border to black */
            color: white;
            padding: 10px; /* Adjust padding to make the button smaller */
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px; /* Adjust font size to make the button text smaller */
            margin: 4px 2px;
            border-radius: 50%;
            width: 40px; /* Set button width */
            height: 40px; /* Set button height */
        }
        .color-buttons-container {
            display: flex; /* Use flexbox to arrange buttons horizontally */
        }
    </style>
</head>
@include('user.navbar')

<body>

   @include('admin.errors')


    <div class="container buying">
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        
        <div class="row">
            <div class="product_img col-md-5 text-center">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($productImages as $productImage)
                            
                            <div class="carousel-item active">
                                <img src="{{ asset($productImage->filename) }}" class="d-block w-100" alt="...">
                            </div>
                         
                            @endforeach
                        </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
            <div class="product_info col-md-6 ms-auto">
                {{-- {{$product->productVariants->}} --}}
                <br>
                <p class="product_type">{{ $product->category->name }}</p>
                <h2 class="product_name">{{ $product->name }}</h2>
                <br>
                @if ($product->salePrice !=null)
                <span style="text-decoration: line-through" class="price1"> {{ $product->price }}</span><span class="currency"> L.E </span>
                <span class="price1 ms-4"> {{ $product->salePrice }} </span><span class="currency"> L.E </span>
                @else
                <span class="price1"> {{ $product->price }}</span><span class="currency"> L.E </span>
                @endif

                <p class="mt-3">category:{{ $product->category->name }}</p>

                <p class="product_desc mt-3">{{ $product->desc }}</p>

                <div class=" m-auto">
                   
                    <form class="m-auto counter" action="{{ route('cart.store') }}" method="post">
                        @csrf
                        <select name="productVariantId" id="size">
                            @foreach ($defaultProductVariants as $variant)
                                <option value="{{ $variant->id }}">{{ $variant->size->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="productId" value="{{ $product->id }}">
                        {{-- Other hidden fields if needed --}}
                        <span class="down text-dark" onClick='decreaseCount(event, this)'>-</span>
                        <input class="count bg-dark" name="quantity" type="text" value="1">
                        <span class="up text-dark" onClick='increaseCount(event, this)'>+</span>
                        <button class="button">
                            <span>add to cart</span>
                            <div class="cart">
                                <svg viewBox="0 0 36 26">
                                    <polyline points="1 2.5 6 2.5 10 18.5 25.5 7.5 7.5 7.5"></polyline>
                                    <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                </svg>
                            </div>
                        </button>
                    </form>
                    
         
                    <div class="color-buttons-container">

                        @foreach ($availableColors as $colorId)
                        <form action="{{ route('productDetail', ['id' => $product->id]) }}" method="get">
                        @php
                            $color = Color::where('id', $colorId)->first()                           
                        @endphp
                                <input type="hidden" name="color_id" value="{{ $colorId }}">
                                <button type="submit" class="color-button" style="background-color:{{$color->color_code}}"></button>
                            </form>
                        @endforeach
                    </div>
                    {{-- <div id="sizes-container">
                        @foreach ($defaultProductVariants as $variant)
                            <button> {{$variant->size->name }}</button>
                            <div>{{ $variant->size->name }}</div>
                        @endforeach --}}
                    </div>
                </div>


                <hr>
                <div class="d-flex flex-col">


                    <img src="{{asset('images/siz.jpg')}}"    width="300px" alt="">
                </div>
            </div>
        </div>

        <hr class="mt-5 mb-1">

        @if (isset($relatedProducts))
            
       

        <h1 class="mb-5 text-center">RELATED PRODUCTS</h1>
        <div class="d-flex flex-wrap justify-content-center mb-4">
            @foreach ($relatedProducts->slice(0, 3) as $product)
                <div class="card">
                    {{-- <img src="{{ asset("storage/$product->image1") }}" alt="">
                    <img class="img2" src="{{ asset("storage/$product->image2") }}" alt=""> --}}
                    <img src="{{asset($product->image()->first()->filename)}}" alt="">
                    {{-- <img class="img2" src="{{asset($product->image()->first()->filename)}}" alt=""> --}}
                    @if ($product->image()->count() > 1)
                        <img class="img2" src="{{ asset($product->image()->skip(1)->first()->filename) }}" alt="">
                    @endif
                    <p class="category">{{ $product->category->name }}</p>
                    <p class="product">{{ $product->name }}</p>
                    <span class="price">{{ $product->price }}</span><span
                        class="quantity">{{ $product->quantity }}</span>
                    <button class="btn byebtn"> <a class='buy' href="{{ url("productDetails/$product->id") }}"> Buy
                            Now </a></button>
                </div>
            @endforeach
        </div>
        @endif
    </div>
    <div class="footer">
        <footer class="site-footer">
            <hr>
            <div class="container">
                <div class="row">
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


    <script>
        function selectColor(colorId) {
            // Make AJAX request to reload sizes for selected color
            // Example: You can use jQuery AJAX or fetch API to make a request to the backend
            fetch(`/productDetail/{{ $product->id }}?color_id=${colorId}`)
                .then(response => response.json())
                .then(data => {
                    // Update sizes container with new sizes
                    const sizesContainer = document.getElementById('sizes-container');
                    sizesContainer.innerHTML = ''; // Clear previous sizes
                    data.productVariants.forEach(variant => {
                        sizesContainer.innerHTML += `<div>${variant.size.name}</div>`;
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>
