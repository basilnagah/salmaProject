<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('user/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/chechk.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/media.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <title>salma store</title>
</head>


<body>
    @include('user.navbar')

    <div class="container checkoutpg mt-5"> <br><br><br>
        <h1 class="check">CHECK OUT</h1>
        <br><br>
        <div class="row">
            <div class=" col-lg-6 col-md-7 col-sm-12 persnonal">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger"> {{ $error }} </div>
                    @endforeach
                @endif
                <h2>Personal information</h2>
                <hr>
                <form action="{{ url('order') }}" class="row g-3 needs-validation" method="POST" novalidate>
                    @csrf
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" id="validationCustom01"
                            placeholder="User name" value="{{old('userName') ?? $user->name ?? null}}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6">
                     
                        <div class="input-group has-validation">
                            <input type="number" name="phoneNumber" class="form-control"
                                id="validationCustomUsername" placeholder="Phone Number"
                                aria-describedby="inputGroupPrepend" value="{{old('phoneNumber') ?? $user->phoneNumber ?? null}}" required>
                        </div>
                    </div>
              
                    <div class="col-md-6">
                       
                        <div class="input-group has-validation">
                            <input type="number" name="secondPhoneNumber" class="form-control"
                                id="validationCustomUsername" placeholder="second Phone Number"
                                aria-describedby="inputGroupPrepend" value="{{old('secondPhoneNumber') ?? $user->secondPhoneNumber ?? null}}" required>

                        </div>
                    </div>

                    @if ($user == null)
                        <div class="col-md-6">
                            <div class="input-group has-validation">
                                <input type="email" name="email" class="form-control"
                                    placeholder="Email"
                                    aria-describedby="inputGroupPrepend" value="{{old('email')}}">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group has-validation">
                                <input type="password" name="password" class="form-control"
                                    placeholder="Password"
                                    aria-describedby="inputGroupPrepend">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group has-validation">
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Confirm Password"
                                    aria-describedby="inputGroupPrepend">
                            </div>
                        </div>
                    @endif

                    {{-- <div class="col-md-6">
                        <input type="text" name="country" class="form-control" id="validationCustom03"
                            placeholder="Country" required>
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div> --}}
                    {{-- onchange="fetchRegions(this.value)" --}}
                    <div class="col-md-6">
                        <select class="form-control" id="city_id" name="city_id" onchange="fetchShippingPrice(this.value)">
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div>

                    {{-- <div class="col-md-6">
                        <div class="form-group"> --}}
                            {{-- <label for="region_id">Region</label> --}}
                            {{-- <select class="form-control" id="region_id" name="region_id" onchange="fetchRegionPrice(this.value)">
                                <option value="">Select Region</option> --}}
                                <!-- Regions will be populated dynamically based on the selected city -->
                            {{-- </select>
                        </div>
                    </div> --}}

                    <div class="input-group">
                        <textarea name="address" class="form-control" aria-label="With textarea" placeholder="Detailed Address">{{old('adress')}}</textarea>
                    </div>

                    {{-- <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                required>
                            <label class="form-check-label" for="invalidCheck">
                                Agree to terms and conditions
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div> --}}
                    <input type="hidden" name="total" value="{{$total}}">
                    <button class="orderButton btn btn-success">Place Order</button>
            </div>
            <div class=" col-lg-6 col-md-7 col-sm-12 mb-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <h2>Products</h2>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carts as $cart)
                            <tr>
                                <td> {{--  <img src="{{ asset("storage/$product->image1") }}" alt=""
                                        class="item-img"> --}}
                                    <span id="Product-name"> {{ $cart->product->name }} {{ 'x' }}
                                        {{ $cart->quantity }}</span>
                                </td>
                                <td></td>
                                <td>{{ $cart->product->price * $cart->quantity }} </td>
                                <td></td>
                            </tr>
                        @endforeach

                        {{-- <tr>
                            <td>
                                <h3>Total</h3>
                            </td>
                            <td></td> --}}
                            {{-- <td><span>{{ $total }}</span></td> --}}
                            {{-- <td><span id="totalAmount">{{ $total }}</span> + <span id="shippingAmount">0.00</span></td> --}}
                            {{-- <td>+ مصاريف الشحن</td> --}}
                        {{-- </tr> --}}

                        <tr id="shippingPriceRow" style="display: none;">
                            <td>Shipping Price</td>
                            <td></td>
                            <td id="shippingPriceCell"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Total</h3>
                            </td>
                            <td></td>
                            <td><span id="totalAmount">{{ $total }}</span> + <span id="shippingAmount">0.00</span></td>
                            <input type="hidden" name="shipping_id" id="shipping_id">
                            {{-- <td>+ مصاريف الشحن</td> --}}
                        </tr>

                    </tbody>
                </table>
            </div>
            {{-- <img class="del mt-5" src="{{ asset('images/delll.jpeg') }}" alt=""> --}}
        </form>

        </div>
    </div>

    {{-- <img src="{{asset('images/erg.jpg')}}" alt=""> --}}

</body>
<script src="js/js.js"></script>
<script src="{{ asset('user/js/bootstrap.bundle.min.js') }}"></script>

<script>

    function fetchShippingPrice(cityId) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var price = parseFloat(response.price);
                    var shippingId = parseInt(response.shipping_id);

                    if (!isNaN(price) && !isNaN(shippingId)) {
                        var shippingPriceCell = document.getElementById('shippingPriceCell');
                        var shippingAmount = document.getElementById('shippingAmount');
                        var shippingIdInput = document.getElementById('shipping_id');

                        if (shippingPriceCell && shippingAmount && shippingIdInput) {
                            shippingPriceCell.textContent = price.toFixed(2);
                            shippingAmount.textContent =  + price.toFixed(2);
                            shippingIdInput.value = shippingId; // Set the shipping_id
                            showShippingPriceRow(); // Show the shipping price row
                            // updateTotalAmount(price); // Update the total amount including shipping price
                        }
                    } else {
                        console.error('Invalid price or shipping_id received');
                    }
                } else {
                    console.error('Error fetching shipping price: ' + xhr.status);
                }
            }
        };
        xhr.open('GET', '/getShippingPrice/' + cityId, true); // Adjust the URL to fetch shipping price based on city
        xhr.send();
    }

    function showShippingPriceRow() {
        var shippingPriceRow = document.getElementById('shippingPriceRow');
        shippingPriceRow.style.display = ''; // Show the shipping price row
    }


</script>

</html>
