@extends('admin.layout')


@section('body')

@include('admin.success')




<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">price</th>
        <th scope="col">Quantity</th>
        <th scope="col">sale</th>
        <th scope="col">category</th>
        <th scope="col" class="w-25">Desc</th>
        <th scope="col">image</th>
        <th scope="col">Aciton</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($products as $product )
      <tr>
          <th scope="row">{{$loop->iteration}}</th>
        <td>{{$product->name}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->quantity}}</td>
        <td>{{$product->salePrice}}</td>
        <td>{{$product->category}}</td>
        <td class="w-25">{{$product->desc}}</td>
        <td><img src="{{asset("storage/$product->image1")}}" style="width:150px;height:150px;border-radius:0;" alt="" srcset=""></td>
        <td>
            <form action="{{url("deleteProduct/$product->id")}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">delete</button>
            </form>
            <h1>
                <a class="btn btn-success" href="{{url("editProduct/$product->id")}}" >edit</a>
            </h1>
        </td>
    </tr>
    @endforeach


    </tbody>
  </table>


@endsection
