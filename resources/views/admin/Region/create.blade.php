@extends('admin.layout')


@section('body')

@include('admin.success')
@include('admin.errors')

<div class="card">
  <div class="card-body">
  <form method="POST" action="{{route('region.store')}}">
      @csrf
      <div class="form-group">
        <label for="exampleInputEmail1">Region Name</label>
        <input type="text" name="name" class="form-control text-white" placeholder="Enter name">
      </div>

      <div class="form-group">
        <label for="categorySelect">Cities</label>
        <select name="city_id" class="form-control" id="categorySelect">
            <option value="">Select City</option>
            @foreach($cities as $city)
                <option  value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
      </div>

      <button type="submit" class="btn btn-primary" style="position: relative; left:45%">Submit</button>
  </form>
  </div>
  </div>

@endsection
