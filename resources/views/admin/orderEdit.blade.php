@extends('admin.layout')


@section('body')

    @include('admin.success')
    <form method="POST" action="{{ url("updateOrder/$orders->id") }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            {{-- <label for="exampleInputEmail1">product Name</label>
            <input type="text" name="status" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $orders->status }}"> --}}
                <label for="">pending</label>
                <input type="radio" name='status' value="pending"><br>
                <label for="">delivered</label>
                <input type="radio" name='status' value="delivered">
        </div>




        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
