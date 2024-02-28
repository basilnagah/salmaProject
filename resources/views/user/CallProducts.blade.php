
@extends('user.layout')


@section('body')

    <div class="section_all_products" id="all_products">
        <div class="container-fluid">
            <div class="all_products pt-5 mt-3 " id="all_products">
                <div class="container-fluid  mt-5 mb-5 pb-5">
                    <h2 class="m-auto brand text-center">All Products</h2>
                    <hr class="mt-3 mb-5">
                    <div class="card-group">
                    </div>
                    @if (session()->has('addedToCart'))
                        <p class="alert alert-success w-50 m-auto mb-4">
                            {{ session()->get('addedToCart') }}
                        </p>
                    @endif
                    @if (session()->has('orderStatus'))
                        <p class="alert alert-success w-50 m-auto mb-4">
                            {{ session()->get('orderStatus') }}
                        </p>
                    @endif
                    <div class="d-flex flex-wrap justify-content-center">



                        @foreach ($products as $product)
                            <div class="card ">
                                <img src="{{ asset("storage/$product->image1") }}" alt="">
                                <img class="img2" src="{{ asset("storage/$product->image2") }}" alt="">
                                <p class="category">{{ $product->category }}</p>
                                <p class="product">{{ $product->name }}</p>

                                @if ($product->salePrice != null)
                                    <div class="btn  btn-success w-25 salebtn">SALE</div>
                                    <span class="price text-decoration-line-through ">{{ round($product->price / $currencies)  }}
                                        {{ $currenciesWord }}</span>
                                    <span class="price">{{ round($product->salePrice / $currencies)  }}
                                        {{ $currenciesWord }}</span>
                                @else
                                    <span class="price">{{ round($product->price / $currencies) }}
                                        {{ $currenciesWord }}</span>
                                @endif

                                <span class="quantity">{{ $product->quantity }}</span>
                                @if ($product->quantity == 'in stock')
                                    <button class="btn"> <a class='buy'
                                            href="{{ url("productDetails/$product->id") }}"> Buy Now </a></button>
                                @else
                                    <button disabled class="btn"> <a class='buy'
                                            href="{{ url("CproductDetails/$product->id") }}"> Buy Now </a></button>
                                @endif
                            </div>
                        @endforeach




                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
