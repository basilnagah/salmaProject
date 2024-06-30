@extends('admin.layout')


@section('body')

@include('admin.success')
@include('admin.errors')

<div class="container">
    <h2>Create Shipping</h2>
    <form method="post" action="{{ route('shipping.store') }}" id="shippingForm">
        @csrf
        <div class="form-group">
            <label for="country_id">Country</label>
            <select class="form-control" id="country_id" name="country_id">
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="city_id">City</label>
            <select class="form-control" id="city_id" name="city_id" onchange="fetchRegions(this.value)">
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        {{-- <div class="form-group">
            <label for="region_id">Region</label>
            <select class="form-control" id="region_id" name="region_id">
                <!-- Regions will be populated dynamically based on the selected city -->
            </select>
        </div> --}}

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control text-white" id="exampleInputEmail1" placeholder="Enter price">
        </div>
     
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

{{-- <script>
    function fetchRegions(cityId) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var regions = JSON.parse(xhr.responseText);
                    var regionSelect = document.getElementById('region_id');
                    regionSelect.innerHTML = '';
                    for (var key in regions) {
                        if (regions.hasOwnProperty(key)) {
                            var option = document.createElement('option');
                            option.value = key;
                            option.textContent = regions[key];
                            regionSelect.appendChild(option);
                        }
                    }
                } else {
                    console.error('Error fetching regions: ' + xhr.status);
                }
            }
        };
        xhr.open('GET', '/getRegions/' + cityId, true);
        xhr.send();
    }
</script> --}}

@endsection
