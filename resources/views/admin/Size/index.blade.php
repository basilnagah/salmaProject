@extends('admin.layout')


@section('body')

@include('admin.success')

<div class="container">
  <h2>Sizes</h2>

<div style="">
  <a class="nav-link btn btn-success create-new-button" style="position: relative; left:92%; width:7%"
   href="{{route('size.create')}}">+</a>
</div>
<br>


<div class="card">
  <div class="card-body">

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Size</th>
        {{-- <th scope="col">Aciton</th> --}}
      </tr>
    </thead>
    <tbody>
        @foreach ($sizes as $size )
      <tr>
          <th scope="row">{{$loop->iteration}}</th>
        <td>{{$size->name}}</td>
        <td style="position: relative; right:25%">
            <form action="{{route('size.destroy',$size->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">delete</button>
            </form>
            <h1>
                <a class="btn btn-success" href="{{route('size.edit',$size->id)}}" >edit</a>
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
