@extends('admin.layout')


@section('body')

@include('admin.success')

<div style="">
  <a class="nav-link btn btn-success create-new-button" style="position: relative; left:92%; width:7%"
   href="{{route('shipping.create')}}">+</a>
</div>
<br>
<div class="card">
  <div class="card-body">
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Country</th>
        <th scope="col">City</th>
        {{-- <th scope="col">Rigeon</th> --}}
        <th scope="col">Price</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($shippings as $shipping )
      <tr>
          <td scope="row">{{$loop->iteration}}</td>
        <td>{{$shipping->country->name}}</td>
        <td>{{$shipping->city->name}}</td>
        {{-- <td>{{$shipping->region->name}}</td> --}}
        <td>{{$shipping->price}}</td>
        {{-- <td class="w-25">{{$category->desc}}</td> --}}
        <td >{{--style="position: relative; right:25%" --}}
            <form action="{{route('shipping.destroy',$shipping->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">delete</button>
            </form>
            <h1>
                <a class="btn btn-success" href="{{route('shipping.edit',$shipping->id)}}" >edit</a>
            </h1>
        </td>
    </tr>
    @endforeach


    </tbody>
  </table>

  </div>
  </div>
@endsection
