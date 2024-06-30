@extends('admin.layout')


@section('body')

@include('admin.success')


<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Category</th>
        <th scope="col">name</th>
        <th scope="col">quantity</th>
        <th scope="col">size</th>
        <th scope="col">total price</th>
        <th scope="col">image</th>
        {{-- <th scope="col">status</th> --}}
      </tr>
    </thead>
    <tbody>
        @foreach ($orderItems as $orderItem )
      <tr>
          <th scope="row">{{$loop->iteration}}</th>
        <td>{{$orderItem->product->category->name}}</td>
        <td>{{$orderItem->product->name}}</td>
        <td>{{$orderItem->quantity}}</td>
        <td>{{$orderItem->product_variant->size->name}}</td>
        <td>{{ $orderItem->price * $orderItem->quantity}} </td>
        {{-- <td><img src="{{asset("storage/$orderItem->image")}}" style="width:150px;height:150px;border-radius:0;" alt="" srcset=""></td> --}}
        <td><img src="{{ asset($orderItem->product->image->where('color_id', $orderItem->product_variant->color_id)->first()->filename) }}" alt="Placholder Image 2"
          class="product-frame"></td>
    </tr>
    @endforeach
  </tbody>
</table>
{{-- <textarea name="addres" id="" cols="30" rows="10">{{$order->adress}}</textarea> --}}
<br>
    <table class="table">
      <thead>
        <th scope="col">status</th>
        {{-- <th scope="col">Address</th> --}}
        <th scope="col">Shipping Region</th>
        <th scope="col">Shipping price</th>
        <th scope="col">Sub Total</th>
        <th scope="col">Toral Order</th>
      </thead>
      <tbody>
        <tr>
          <td>
            <form method="POST" action="{{route('updateOrderStatus',$orderItem->order_id)}}">
              @csrf
              @method('PUT')
              <div class="form-group d-flex">
                  <select name="status" class="form-control">
                      <option value="{{$orderItem->Order->status}}">{{$orderItem->Order->status}}</option>
                      <option value="pending">Pending</option>
                      <option value="in_progress">In Progress</option>
                      <option value="out_for_delivery">Out For Delivery</option>
                      <option value="delivered">Delivered</option>
                  </select>
                  <button type="submit" class="btn btn-success">Approve</button>
              </div>
            </form>
          </td>
          {{-- <td> --}}
            {{-- <textarea class="form-control text-white" name="" id="" cols="30" rows="10">{{$order->adress}}</textarea> --}}
            {{-- <span> {{$order->adress}}</span> --}}
            {{-- <p>{{$order->adress}}</p> --}}

          {{-- </td> --}}
          <td>
            <span>{{ $order->shipping->region->name }}</span>
          </td>
          <td>
            <span>{{ $order->shipping->price }}</span>
          </td>
          <td>
            <span>{{ $order->sub_total }}</span>
          </td>
          <td>
            <span>{{ $order->total }}</span>
          </td>
        </tr>
      </tbody>
    </table>
    <br>
    {{-- <p style="color:#6f7a95">Address: {{$order->adress}}</p> --}}

    <table class="table">
      <thead>  
        <th scope="col" style="font-size: xx-large">Address</th>
      </thead>
      <tbody>
        <td>
          <p style="color:#6f7a95" style="font-size: medium">{{$order->adress}}</p>
        </td>
      </tbody>

    </table>

    {{-- <label for="exampleInputEmail1">Address of: {{$order->adress}}</label> --}}


@endsection
