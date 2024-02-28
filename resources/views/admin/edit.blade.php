@extends('admin.layout')


@section('body')

    @include('admin.success')
    <form method="POST" action="{{ url("updateProduct/$product->id") }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            <label for="exampleInputEmail1">product Name</label>
            <input type="text" name="name" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $product->name }}">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">product desc</label>
            <textarea type="text" name="desc" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp">{{ $product->desc }}</textarea>
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">product Price</label>
            <input type="number" name="price" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $product->price }}">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">product category</label>
            <input type="text" name="category" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $product->category }}">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">product quantity</label>
            <input type="text" name="quantity" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $product->quantity }}">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1"> sale</label>
            <input type="text" name="sale" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $product->sale }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">price after sale</label>
            <input type="number" name="salePrice" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $product->salePrice }}">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">old image</label>
            <img src="{{ asset("storage/$product->image1") }}" width="100" alt="" srcset="">
            <img src="{{ asset("storage/$product->image2") }}" width="100" alt="" srcset="">
            <img src="{{ asset("storage/$product->image3") }}" width="100" alt="" srcset="">
            <img src="{{ asset("storage/$product->image4") }}" width="100" alt="" srcset="">
            <img src="{{ asset("storage/$product->image5") }}" width="100" alt="" srcset="">
            <img src="{{ asset("storage/$product->c") }}" width="100" alt="" srcset="">
            <input type="file" name="image1" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter email">
                <input type="file" name="image2" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter email">
                <input type="file" name="image3" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter email">
                <input type="file" name="image4" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter email">
                <input type="file" name="image5" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter email">
        </div>



        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
