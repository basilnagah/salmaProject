@extends('admin.layout')


@section('body')

    @include('admin.success')
    <form method="POST" action="{{ url("updateCurnncy/$currncy->id") }}" enctype="multipart/form-data">
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
            <label for="exampleInputEmail1">exchange rate</label>
            <input type="text" name="exchange_rate" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" value="{{ $currncy->exchange_rate }}">
        </div>





        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
