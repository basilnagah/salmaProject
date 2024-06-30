@extends('admin.layout')


@section('body')

@include('admin.success')
<div class="container">
  <h2>APP SETTINGS</h2>
<div style="">
  <a class="nav-link btn btn-success create-new-button" style="position: relative; left:92%; width:7%"
   href="{{route('appSettings.create')}}">+</a>
</div>
<br>
<div class="card">
  <div class="card-body">
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Key</th>
        <th scope="col">Title</th>
        {{-- <th scope="col">Description</th> --}}
        <th scope="col">Aciton</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($appSettings as $appSetting )
      <tr>
          <td scope="row">{{$loop->iteration}}</td>
        <td>{{$appSetting->key}}</td>
        <td>{{$appSetting->title}}</td>
        {{-- <td>{{$appSetting->desc}}</td> --}}
        {{-- <td class="w-25">{{$category->desc}}</td> --}}
        <td >{{--style="position: relative; right:25%" --}}
          <br>
            <form action="{{route('appSettings.delete',$appSetting->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">delete</button>
            </form>
            <h1>
                <a class="btn btn-success" href="{{route('appSettings.edit',$appSetting->id)}}" >edit</a>
            </h1>

            <a class="btn btn-success" href="{{route('appSettings.show',$appSetting->id)}}">show</a>

        </td>
    </tr>
    @endforeach


    </tbody>
  </table>

  </div>
  </div>
</div>
@endsection
