@extends('admin.layout')


@section('body')

@include('admin.success')

    <style>
        .table{
            color: whitesmoke;
        }

        .product-grid {
    display: grid;
    grid-template-columns: 1fr 2fr; /* Adjust column widths as needed */
    grid-gap: 20px; /* Adjust the gap between grid items */
}

.product-images img {
    max-width: 100%;
    height: auto;
}

.product-variants table {
    width: 100%;
}

.product-variants th,
.product-variants td {
    text-align: center;
}

.product-variants .quantity {
    margin-bottom: 5px;
    font-weight: bold;
}

.product-variants .color {
    font-style: italic;
}
    </style>

<div class="row container my-5">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs nav-primary" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab"
                        aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                            </div>
                            <div class="tab-title">product</div>
                        </div>
                    </a>
                </li>
               
            </ul>
            {{-- <div class="product-images"> --}}
                {{-- @if($productImages)
                @foreach ($productImages as $image) --}}
                    {{-- <img src="{{asset($productImage->filename)}}" alt="Product Image"> --}}
                {{-- @endforeach
            @else
                <p>No images available</p>
            @endif --}}
            {{-- </div> --}}
            <div class="tab-content py-3">
                <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            {{-- <thead>
                            <th scope="col" width="20%">Name</th>
                            <th scope="col" width="1%">Guard</th>
                            </thead> --}}
                                <tr>
                                    <td  style="color: whitesmoke;">Product Name</td>
                                    <td style="color: whitesmoke;">{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <td style="color: whitesmoke;">Product description</td>
                                    <td style="color: whitesmoke;">{{ $product->desc }}</td>
                                </tr>
                                <tr>
                                    <td style="color: whitesmoke;">Product Category</td>
                                    <td style="color: whitesmoke;">{{ $product->category->name }}</td>
                                </tr>
                                <tr>
                                    <td style="color: whitesmoke;">Product Price</td>
                                    <td style="color: whitesmoke;">{{ $product->price }}</td>
                                </tr>
                                <tr>
                                    <td style="color: whitesmoke;">Product sale</td>
                                    <td style="color: whitesmoke;">{{ $product->sale }}</td>
                                </tr>
                        </table>
                    </div>
                </div>

                <div class="card-body"> 

                    <div>
                        <table class="table table-striped table-bordered" style="margin-left: 15px; margin-top: 15px;">
                            <thead>
                                <tr>
                                    <th scope="col">Sizes</th>
                                    @foreach ($productVariants->unique('color_id') as $variant)
                                        <th scope="col">{{$variant->color->name}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productVariants->unique('size_id') as $variant)
                                    <tr>
                                        <td style="color: whitesmoke;">{{$variant->size->name}}</td>
                                        @foreach ($productVariants->where('size_id', $variant->size_id)->unique('color_id') as $colorVariant)
                                            <td style="color: whitesmoke;">
                                                Quantity: {{$productVariants->where('size_id', $variant->size_id)->where('color_id', $colorVariant->color_id)->first()->quantity ?? 0}}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                  
                    
    
                </div>
@endsection