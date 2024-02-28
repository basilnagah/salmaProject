@extends('admin.layout')


@section('body')

@include('admin.success')




<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">quantity</th>
        <th scope="col">size</th>
        <th scope="col">total price</th>
        <th scope="col">image</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($orderItems as $orderItem )
      <tr>
          <th scope="row">{{$loop->iteration}}</th>
        <td>{{$orderItem->name}}</td>
        <td>{{$orderItem->quantity}}</td>
        <td>{{$orderItem->size}}</td>
        <td>{{$orderItem->price * $orderItem->quantity}} </td>
        <td><img src="{{asset("storage/$orderItem->image")}}" style="width:150px;height:150px;border-radius:0;" alt="" srcset=""></td>

    </tr>
    @endforeach


    </tbody>
  </table>


@endsection
