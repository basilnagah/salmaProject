@extends('admin.layout')


@section('body')

@include('admin.success')
@include('admin.errors')
<form method="POST" action="{{url('store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">product Name</label>
      <input type="text" name="name" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
    </div>


    <div class="form-group">
        <label for="exampleInputEmail1">product desc</label>
        <textarea type="text" name="desc" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter desc"></textarea>
      </div>
    <div class="form-group">
        <label for="exampleInputEmail1">product category</label>
        <textarea type="text" name="category" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category"></textarea>
      </div>


      <div class="form-group">
        <label for="exampleInputEmail1">product Price</label>
        <input type="number" name="price" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">sale</label>
        <input type="text" name="sale" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">price after sale</label>
        <input type="number" name="salePrice" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">
      </div>


      <div class="form-group">
        <label for="exampleInputEmail1">product quantity</label>
        <input type="text" name="quantity" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">
      </div>


      <div class="form-group">
        <label for="exampleInputEmail1">product image</label>
        <input type="file" name="image1" class="form-control text-white mb-3" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <input type="file" name="image2" class="form-control text-white mb-3" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <input type="file" name="image3" class="form-control text-white mb-3" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <input type="file" name="image4" class="form-control text-white mb-3" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <input type="file" name="image5" class="form-control text-white mb-3" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      </div>


    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
