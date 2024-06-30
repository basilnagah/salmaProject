@extends('admin.layout')


@section('body')

@include('admin.success')
@include('admin.errors')

<style>

  option{
    color: white;
  }
</style>

<div class="card">
  <div class="card-body">
  <form method="POST" action="{{route('appSettings.update',$appSetting->id)}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      @if ($appSetting->image)
      <div class="form-group">

        <img src="{{asset($appSetting->image->filename)}}" alt="">

      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Key</label>
        {{-- <input type="text" name="key" class="form-control text-white" placeholder="Enter Key"> --}}

        <select name="key" class="form-control" >
          <option value="">Select Key</option>
          <option value="HomeImage">Home Image</option>
        </select>
      </div>

      <div class="form-group">
      <input type="file" name="image" class="form-control text-white" id="">
    </div>


  </div>
  @endif

  <div class="form-group">
    @if (!$appSetting->image)
        <label for="exampleInputEmail1">Key</label>
        {{-- <input type="text" name="key" class="form-control text-white" placeholder="Enter Key"> --}}

        <select name="key" class="form-control" >
          <option value="">Select Key</option>
          <option value="HomeImage">Home Image</option>
          <option value="ReturnPolicy">Return Policy</option>
          <option value="shippingPolicy">shipping Policy</option>
          <option value="Whatsapp">Whatsapp</option>
          <option value="instgram">instgram</option>
          <option value="facebook">facebook</option>
        </select>
      </div>

      <div class="form-group">
        <label for="categorySelect">title</label>
        <input type="text" name="title" class="form-control text-white" placeholder="Enter Title" value="{{$appSetting->title ?? null}}">

        {{-- <select name="country_id" class="form-control" id="categorySelect">
            <option value="">Select Country</option>
            @foreach($countries as $country)
                <option  value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select> --}}
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Description</label>
        {{-- <input type="text" name="desc" class="form-control text-white" placeholder="Enter Description"> --}}
        <textarea class="form-control text-white" style="height: 10%" name="desc"cols="30" rows="10">{{$appSetting->desc ?? null}}</textarea>
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Home Image</label>
        <input type="file" name="image" class="form-control text-white">
      </div>

      @endif
      <button type="submit" class="btn btn-primary" style="position: relative; left:45%">Submit</button>
  </form>
  </div>
  </div>

@endsection
