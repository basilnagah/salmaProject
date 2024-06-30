@extends('admin.layout')


@section('body')

@include('admin.success')
@include('admin.errors')

<div class="card">
  <div class="card-body">
  <form method="POST" action="{{route('color.update')}}">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" value="{{$color->id}}">
      <div class="form-group">
        <label for="exampleInputEmail1">color Name</label>
        <input type="text" name="colorName" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" value="{{$color->name}}">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Color Code</label>
        <input type="text" name="colorCode" class="form-control text-white" placeholder="Enter Code" value="{{$color->color_code}}">
      </div>

      <button type="submit" class="btn btn-primary" style="position: relative; left:45%">Submit</button>
  </form>
  </div>
  </div>

@endsection
