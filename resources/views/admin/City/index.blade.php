@extends('admin.layout')


@section('body')

@include('admin.success')
<div class="container">
  <h2>City</h2>
<div style="">
  <a class="nav-link btn btn-success create-new-button" style="position: relative; left:92%; width:7%"
   href="{{route('city.create')}}">+</a>
</div>
<br>
<div class="card">
  <div class="card-body">
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">Aciton</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($Cities as $City )
      <tr>
          <td scope="row">{{$loop->iteration}}</td>
        <td>{{$City->name}}</td>
        {{-- <td class="w-25">{{$category->desc}}</td> --}}
        <td >{{--style="position: relative; right:25%" --}}
            <form action="{{route('city.destroy',$City->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">delete</button>
            </form>
            <h1>
                <a class="btn btn-success" href="{{route('city.edit',$City->id)}}" >edit</a>
            </h1>
        </td>
    </tr>
    @endforeach


    </tbody>
  </table>

  </div>
  </div>
</div>
@endsection
