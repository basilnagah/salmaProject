@extends('admin.layout')


@section('body')

@include('admin.success')
@include('admin.errors')

<div class="card">
  <div class="card-body">
  <form method="POST" action="{{route('size.update')}}">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" value="{{$size->id}}">
      <div class="form-group">
        <label for="exampleInputEmail1">Size</label>
        <input type="text" name="sizeName" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" value="{{$size->name}}">
      </div>
      <button type="submit" class="btn btn-primary" style="position: relative; left:45%">Submit</button>
  </form>
  </div>
  </div>

@endsection
