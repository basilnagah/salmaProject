@extends('admin.layout')


@section('body')

@include('admin.success')
@include('admin.errors')

<div class="card">
  <div class="card-body">
  <form method="POST" action="{{route('city.update')}}">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" value="{{$city->id}}">
      <div class="form-group">
        <label for="exampleInputEmail1">City Name</label>
        <input type="text" name="name" class="form-control text-white" placeholder="Enter name" value="{{$city->name}}">
      </div>

      <div class="form-group">
        <label for="categorySelect">Countries</label>
        <select name="country_id" class="form-control">
            <option value="{{$city->country_id}}">{{$city->country->name}}</option>
            @foreach($countries as $country)
                <option  value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
      </div>

      <button type="submit" class="btn btn-primary" style="position: relative; left:45%">Submit</button>
  </form>
  </div>
  </div>

@endsection
