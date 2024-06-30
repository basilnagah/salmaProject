@extends('admin.layout')


@section('body')

@include('admin.success')
<div class="container">
  <h2>Colors</h2>

<div style="">
  <a class="nav-link btn btn-success create-new-button" style="position: relative; left:92%; width:7%"
   href="{{route('color.create')}}">+</a>
</div>
<br>

<div class="card">
  <div class="card-body">

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Color</th>
        <th scope="col">Color Code</th>
        <th scope="col">Aciton</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($colors as $color )
      <tr>
          <th scope="row">{{$loop->iteration}}</th>
        <td>{{$color->name}}</td>
        {{-- <td class="w-25">{{$color->desc}}</td> --}}
        <td>{{$color->color_code}}</td>
        <td style="position: relative; right:2%">
          <h1>
            <a class="btn btn-success" href="{{route('color.edit',$color->id)}}" >edit</a>
        </h1>
            <form action="{{route('color.destroy',$color->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">delete</button>
            </form>
           
        </td>
    </tr>
    @endforeach


    </tbody>
  </table>

  </div>
  </div>
</div>
  
@endsection
