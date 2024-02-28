@extends('admin.layout')


@section('body')

@include('admin.success')




<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">curnncy Name</th>
        <th scope="col">curnncy Price</th>
        <th scope="col">Aciton</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($currncy as $currncyOne )
      <tr>
          <th scope="row">{{$loop->iteration}}</th>
        <td>{{$currncyOne->currncy_code}}</td>
        <td>{{$currncyOne->exchange_rate}}</td>
        <td>
            <h1>
                <a class="btn btn-success" href="{{url("editCurrncy/$currncyOne->id")}}" >edit</a>
            </h1>
        </td>
    </tr>
    @endforeach


    </tbody>
  </table>


@endsection
