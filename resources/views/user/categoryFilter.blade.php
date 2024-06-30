@extends('user.layout')

 

@include('admin.navbar')

@section('body')
    <div class="section_all_products" id="all_products">
        <div class="container-fluid">
            <div class="all_products pt-5 mt-3 " id="all_products">
                <div class="container-fluid  mt-5 mb-5 pb-5">
                    {{-- <img class="logo m-auto" src="{{asset('images/log.jpeg')}}"alt=""> --}}
                    {{-- <h2 class="m-auto brand text-center">All Products</h2> --}}
                    <hr class="mt-3 mb-5">
                    <div class="card-group">
                    </div>
                    @if (session()->has('addedToCart'))
                        <p style="font-size: 16px;" class="alert alert-success w-50 m-auto mb-4">
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
                               {{-- <a href="{{ url("productDetails/$product->id") }}"> <img src="{{ asset("storage/$product->image1") }}" alt=""></a>
                               <a href="{{ url("productDetails/$product->id") }}">  <img class="img2" src="{{ asset("storage/$product->image2") }}" alt=""></a> --}}
                               <a href="{{ url("productDetails/$product->id") }}"><img src="{{asset($product->image()->first()->filename)}}" alt=""></a>
                               {{-- <img class="img2" src="{{asset($product->image()->first()->filename)}}" alt=""> --}}
                               @if ($product->image()->count() > 1)
                                   <!-- Display the second image if it exists -->
                                   <a href="{{ url("productDetails/$product->id") }}"><img class="img2" src="{{ asset($product->image()->skip(1)->first()->filename) }}" alt=""></a>
                               @endif
                                <p class="category">{{$product->category->name}}</p>
                                <p class="product">{{ $product->name }}</p>
                                @if ($product->salePrice != null)
                                    <div class="btn  btn-success w-25 btnsale">SALE</div>
                                    <span class="price text-decoration-line-through">{{ $product->price }}</span>
                                    <span class="price">{{ $product->salePrice }}</span>
                                @else
                                    <span class="price">{{ $product->price }}</span>
                                @endif
                                @if ($product->quantity == 'in stock')
                                <button class="btn byebtn"> <a class='buy'
                                    href="{{ url("productDetails/$product->id") }}"> Buy Now </a></button>
                                    @else
                                    <span class="quantity">{{ $product->quantity }}</span>
                                    <button disabled class="btn"> <a class='buy'
                                            href="{{ url("productDetails/$product->id") }}"> Buy Now </a></button>
                                @endif
                            </div>
                        @endforeach



                    </div>
                    {{-- <div class="pag">

                        {{ $products->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
