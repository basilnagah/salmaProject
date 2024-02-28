@extends('admin.layout')


@section('body')

@include('admin.success')




<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">Phone number</th>
        <th scope="col">Phone number 2</th>
        <th scope="col">adress</th>
        <th scope="col">city</th>
        <th scope="col">status</th>
        <th scope="col">options</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order )
      <tr>
          <th scope="row">{{$loop->iteration}}</th>
        <td>{{$order->firstName}} {{$order->lastName}}</td>
        <td>{{$order->phoneNumber}}</td>
        <td>{{$order->secondPhoneNumber}}</td>
        <td>{{$order->adress}}</td>
        <td>{{$order->city}}</td>
        <td>{{$order->status}}</td>
        <td>
            <h1>
                <a class="btn btn-success" href="{{url("editOrder/$order->id")}}" >edit</a>
            </h1>
        </td>
        <td>
            <h1>
                <a class="btn btn-primary" href="{{url("viewOrder/$order->id")}}" >view</a>
            </h1>
        </td>
    </tr>
    @endforeach


    </tbody>
  </table>


@endsection
