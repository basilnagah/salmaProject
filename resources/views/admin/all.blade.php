@extends('admin.layout')


@section('body')

@include('admin.success')


<style>
    /* Style the toggle button */
    .toggle-button {
        width: 50px;
        height: 25px;
        border-radius: 25px;
        background-color: #ccc;
        cursor: pointer;
        position: relative;
    }

    /* Style the inner circle for active state */
    .toggle-button::before {
        content: '';
        position: absolute;
        width: 21px;
        height: 21px;
        border-radius: 50%;
        background-color: white;
        top: 50%;
        left: 2px;
        transform: translateY(-50%);
        transition: transform 0.2s ease;
    }

    /* Style for active state */
    .toggle-button.active::before {
        transform: translateX(25px);
    }
</style>

<div class="card">
    <div class="card-body">
        <div class="mt-2">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">price</th>
                    {{-- <th scope="col">Quantity</th> --}}
                    <th scope="col">sale</th>
                    <th scope="col">category</th>
                    <th scope="col" class="w-25">Desc</th>
                    <th scope="col">image</th>
                    <th scope="col">Best Selling</th>
                    <th scope="col">Aciton</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product )
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    {{-- <td>{{$product->quantity}}</td> --}}
                    <td>{{$product->salePrice}}</td>
                    <td>{{$product->category->name}}</td>
                    <td class="w-25">{{$product->desc}}</td>
                    <td><img src="{{asset($product->image()->first()->filename)}}" style="width:150px;height:150px;border-radius:0;" alt="" srcset=""></td>
                    <td>
                        @if ($product->best_selling)
                            <div class="form-check form-switch">
                                <input class="form-check-input active" onchange="changeStatus(this)"
                                    data-url="{{url("/products/$product->id/updateStatus") }}"
                                    class="toggle-class" type="checkbox"
                                    @checked($product->best_selling)>
                            </div>
                        @else
                            <div class="form-check form-switch">
                                <input class="form-check-input not_active" onchange="changeStatus(this)"
                                    data-url="{{ url("/products/$product->id/updateStatus") }}"
                                    class="toggle-class" type="checkbox"
                                    @checked($product->best_selling)>
                            </div>

                        @endif
                    </td>
                    <td>
                        <a class="btn btn-success" href="{{route('products.show',$product->id)}}">show</a>

                        <h1>
                            <a class="btn btn-success" href="{{url("editProduct/$product->id")}}" >edit</a>
                        </h1>
                        
                        <form action="{{route('products.delete',$product->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">delete</button>
                        </form>
                        {{-- <h1>
                            <a class="btn btn-success" href="{{url("editProduct/$product->id")}}" >edit</a>
                        </h1> --}}
                    </td>
                    {{-- <td>
                        <div class="btn-group">
                            <a class="btn btn-success" href="{{route('products.show',$product->id)}}">Show</a>
                            <form action="{{route('products.delete',$product->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a class="btn btn-success" href="{{url("editProduct/$product->id")}}" >Edit</a>
                        </div>
                    </td> --}}
                </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>

  {{-- <script>
    // Add event listener to toggle the checked state of the custom checkbox and update hidden input
    var customCheckbox = document.getElementById('customCheckbox');
    var hiddenInput = document.getElementById('bestSellingValue');
    customCheckbox.addEventListener('click', function() {
        this.classList.toggle('checked');
        if (this.classList.contains('checked')) {
            hiddenInput.value = 1;
        } else {
            hiddenInput.value = 0;
        }
    });
  </script> --}}

  {{-- <script>
    function toggleBestSelling(button) {
        // Toggle the active class on the button
        button.classList.toggle('active');
        
        // Update the hidden input value based on the button's active state
        var bestSellingCheckbox = document.getElementById('bestSellingCheckbox');
        bestSellingCheckbox.value = button.classList.contains('active') ? 1 : 0;
        
        // Send AJAX request to update the state
        var formData = new FormData(document.getElementById('bestSellingForm'));
        var xhr = new XMLHttpRequest();
        xhr.open('POST', "{{ url("updateBestSelling/$product->id") }}", true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Request was successful
                console.log('State updated successfully.');
            } else {
                // Error handling
                console.error('Error updating state.');
            }
        };
        xhr.onerror = function () {
            // Error handling
            console.error('Error updating state.');
        };
        xhr.send(formData);
    }
</script> --}}
    <script type="text/javascript">
        function changeStatus(x) {
            console.log(x);
            url = $(x).attr("data-url");
            if ($(x).hasClass('active')) {
                x.classList.remove("active");
                x.classList.add("not_active");
            } else {
                x.classList.remove("not_active");
                x.classList.add("active");
            }

            $.ajax({
                method: "get",
                url: url,
                success: function(success) {
                    console.log(success);
                }
            })
        }
    </script>
    <script type="text/javascript">
        $('#is_active').on('change', function(e) {
            var is_active = $('#is_active').val();
            var table = $('#example');
            console.log(is_active);
            if (is_active == 1) {
                table.find('.not_active').parents('tr').hide();
                table.find('.active').parents('tr').show();
            } else if (is_active == 0) {
                table.find('.not_active').parents('tr').show();
                table.find('.active').parents('tr').hide();
            } else {
                table.find('td').parent().show();
            }
        });
    </script>


    <!-- Inside the head section of your HTML -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let toggleSwitches = document.querySelectorAll('.status-toggle');

            toggleSwitches.forEach(function(switchElement) {
                switchElement.addEventListener('change', function() {
                    let hiddenInput = this.closest('.toggle-switch').querySelector('input[type="hidden"]');
                    hiddenInput.value = this.checked ? 0 : 1;

                    // You can optionally submit the form here or perform other actions
                    // Example: this.closest('form').submit();
                });
            });
        });
    </script>

    <!-- Include SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script type="text/javascript">
        function changeStatus(x) {
            console.log(x);
            url = $(x).attr("data-url");
            if ($(x).hasClass('active')) {
                x.classList.remove("active");
                x.classList.add("not_active");
            } else {
                x.classList.remove("not_active");
                x.classList.add("active");
            }

            $.ajax({
                method: "get",
                url: url,
                success: function(success) {
                }
            })
        }
    </script>
@endsection
