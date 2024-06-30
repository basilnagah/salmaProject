@extends('admin.layout')

@section('body')
<style>
    /* CSS to change text color to white */
    #categorySelect option {
        color: white;
    }
  
    .form-group input[type="checkbox"] {
          display: none;
    }
    
    /* Style the custom checkbox */
    .custom-checkbox {
        display: inline-block;
        width: 20px;
        height: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 3px;
        cursor: pointer;
        vertical-align: middle;
    }
  
    /* Change background color of custom checkbox when checked */
    .custom-checkbox.checked {
        background-color: #007bff; /* Change to your desired color */
        border-color: #007bff;
    }
  
    /* Show a checkmark when the checkbox is checked */
    .custom-checkbox.checked::after {
        content: "\2713"; /* Checkmark symbol */
        font-size: 16px;
        color: #fff; /* Change to your desired color */
        display: block;
        text-align: center;
        line-height: 18px;
    }
  
    /* Custom styling for multiple select */
  .multiple-select {
      height: auto;
      min-height: 100px; /* Adjust the height as needed */
      overflow-y: auto;
      border: 1px solid #ced4da;
      border-radius: 4px;
      padding: 6px 12px;
  }
  
  /* Style for options */
  .multiple-select option {
      padding: 5px;
  }
  
  /* Style for hover effect */
  .multiple-select option:hover {
      background-color: #f0f0f0;
  }
</style>  
<div class="container">
    <h2>Edit Product</h2>
    @include('admin.success')
    @include('admin.errors')
    <form method="POST" action="{{ url("updateProduct/$product->id") }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Product Name -->
       
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}">
        </div>

        <!-- Product Description -->
        <div class="form-group">
            <label for="desc">Product Description</label>
            <textarea name="desc" class="form-control" id="desc" rows="3">{{ $product->desc }}</textarea>
        </div>

        {{-- Product Category --}}
        <div class="form-group">
            <label for="categorySelect">Product category</label>
            <select name="category_id" class="form-control" id="categorySelect">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Product Price -->
        <div class="form-group">
            <label for="price">Product Price</label>
            <input type="number" name="price" class="form-control" id="price" value="{{ $product->price }}">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">sale</label>
            <input type="text" name="sale" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">price after sale</label>
            <input type="number" name="salePrice" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">
          </div>

        {{-- <!-- Product Images -->
        <div class="form-group">
            <label for="images">Product Images</label>
            <input type="file" name="images[]" class="form-control" id="images" multiple accept="image/*">
        </div> --}}

        <!-- Product Colors -->
        {{-- <div class="form-group">
            <label for="colors">Product Colors</label>
            <select name="colors[]" class="form-control" id="colors" multiple>
                @foreach($colors as $color)
                    @php
                        // Check if the color is associated with the product through ProductVariants
                        $isSelected = $product->productVariants()->where('color_id', $color->id)->exists();
                    @endphp
                    <option value="{{ $color->id }}" {{ $isSelected ? 'selected' : '' }}>
                        {{ $color->name }}
                    </option>
                @endforeach
            </select>
        </div> --}}

        <!-- Best Selling Checkbox -->
        {{-- <div class="form-check">
            <input type="checkbox" name="best_selling" class="form-check-input" id="best_selling" {{ $product->best_selling ? 'checked' : '' }}>
            <label class="form-check-label" for="best_selling">Best Selling</label>
        </div> --}}

        {{-- <div class="form-group">
            <label for="exampleInputEmail1">Best Selling</label>
            <br>
            <div class="custom-checkbox" id="customCheckbox"></div>
            <input type="hidden" name="best_selling" id="bestSellingValue" value="0">
            <input type="checkbox" name="bestSellingCheckbox" class="form-control checkbox-white">
        </div> --}}

        <div class="col-md-3 text-end d-grid">
            <button type="button" name="datetime" id="myButton" onclick="AddColorWithImages();" class="btn btn-primary">Add Color with Images</button>
        </div>
        
        <div class="col-md-3 text-end d-grid">
            <button type="button" name="undoButton" id="undoButton" onclick="UndoLastInput();" class="btn btn-danger">Undo Last Input</button>
        </div>
        
        <!-- Container for dynamically added color and image upload fields -->
        <div class="form-row mt-3" id="color-images-container">
            <!-- This container will hold dynamically added color and image upload fields -->
        </div>
        
        <br>
        
        <div class="form-group">
            <label for="sizes">Sizes:</label>
            <select name="sizes[]" class="form-control multiple-select" multiple>
                @foreach($sizes as $size)
                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                @endforeach
            </select>
        </div>
        
        @foreach($product->productVariants as $variant)
            <div class="form-group">
                <label for="quantity_{{ $variant->color_id }}_{{ $variant->size_id }}">Quantity for {{ $variant->color->name }} - {{ $variant->size->name }}:</label>
                <input type="number" name="quantity_{{ $variant->color_id }}_{{ $variant->size_id }}" class="form-control" value="{{ $variant->quantity }}" min="0">
            </div>
        @endforeach
        
        <hr>

        @foreach($colors as $color)
        @foreach($sizes as $size)
            <div class="form-group">
                <label for="quantity_{{ $color->id }}_{{ $size->id }}">Quantity for {{ $color->name }} - {{ $size->name }}:</label>
                <input type="number" name="quantity_{{ $color->id }}_{{ $size->id }}" class="form-control" value="0" min="0">
            </div>
        @endforeach
    @endforeach

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

{{-- *CheckBox-BestSelling* --}}
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
<script>
  var colors = {!! json_encode($colors) !!};
</script>
<script>
  var colorCount = 0;

  function AddColorWithImages() {
    colorCount++;

    var colorImagesContainer = document.getElementById('color-images-container');

    // Create a new div to hold color and image upload fields
    var colorDiv = document.createElement('div');
    colorDiv.className = 'col-12 mt-3';

    // Create label for color selection
    var colorLabel = document.createElement('label');
    colorLabel.textContent = 'Color:';
    colorDiv.appendChild(colorLabel);

    // Create color select dropdown
    var colorSelect = document.createElement('select');
    colorSelect.name = 'colors[]';
    colorSelect.id = 'color_' + colorCount; // Add an ID for referencing later
    colorSelect.className = 'form-control';
    colorSelect.required = true;

    // Populate color options dynamically
    colors.forEach(function(color) {
        var option = document.createElement('option');
        option.value = color.id;
        option.textContent = color.name;
        colorSelect.appendChild(option);
    });
    colorDiv.appendChild(colorSelect);

    // Create label for image upload
    var imageLabel = document.createElement('label');
    imageLabel.textContent = 'Images for ' + colors[colorSelect.selectedIndex].name + ':';
    colorDiv.appendChild(imageLabel);

    // Create input for image upload
    var imageInput = document.createElement('input');
    imageInput.type = 'file';
    imageInput.name = 'images_' + colors[colorSelect.selectedIndex].id + '[]'; // Adjust input name
    imageInput.className = 'form-control';
    imageInput.accept = 'image/*';
    imageInput.multiple = true; // Allow multiple image selection
    colorDiv.appendChild(imageInput);

    // Listen for change event on color select to update image upload label and input name
    colorSelect.addEventListener('change', function() {
        imageLabel.textContent = 'Images for ' + colors[colorSelect.selectedIndex].name + ':';
        imageInput.name = 'images_' + colors[colorSelect.selectedIndex].id + '[]';
    });

    // Append the new color and image upload fields to the container
    colorImagesContainer.appendChild(colorDiv);
  }

  function UndoLastInput() {
    var colorImagesContainer = document.getElementById('color-images-container');
    var lastInput = colorImagesContainer.lastElementChild;
    if (lastInput) {
      colorImagesContainer.removeChild(lastInput);
    } else {
      alert("No inputs to undo!");
    }
  }

</script>

<script>
    var colors = {!! json_encode($colors) !!};
</script>
<script>
    var colorCount = {{ count($product->productVariants) }};

    function AddColorWithImages() {
        colorCount++;

        var colorImagesContainer = document.getElementById('color-images-container');

        // Create a new div to hold color and image upload fields
        var colorDiv = document.createElement('div');
        colorDiv.className = 'col-12 mt-3';

        // Create label for color selection
        var colorLabel = document.createElement('label');
        colorLabel.textContent = 'Color:';
        colorDiv.appendChild(colorLabel);

        // Create color select dropdown
        var colorSelect = document.createElement('select');
        colorSelect.name = 'colors[]';
        colorSelect.id = 'color_' + colorCount; // Add an ID for referencing later
        colorSelect.className = 'form-control';
        colorSelect.required = true;

        // Populate color options dynamically
        colors.forEach(function(color) {
            var option = document.createElement('option');
            option.value = color.id;
            option.textContent = color.name;
            colorSelect.appendChild(option);
        });
        colorDiv.appendChild(colorSelect);

        // Create label for image upload
        var imageLabel = document.createElement('label');
        imageLabel.textContent = 'Images for ' + colors[colorSelect.selectedIndex].name + ':';
        colorDiv.appendChild(imageLabel);

        // Create input for image upload
        var imageInput = document.createElement('input');
        imageInput.type = 'file';
        imageInput.name = 'images_' + colors[colorSelect.selectedIndex].id + '[]'; // Adjust input name
        imageInput.className = 'form-control';
        imageInput.accept = 'image/*';
        imageInput.multiple = true; // Allow multiple image selection
        colorDiv.appendChild(imageInput);

        // Listen for change event on color select to update image upload label and input name
        colorSelect.addEventListener('change', function() {
            imageLabel.textContent = 'Images for ' + colors[colorSelect.selectedIndex].name + ':';
            imageInput.name = 'images_' + colors[colorSelect.selectedIndex].id + '[]';
        });

        // Append the new color and image upload fields to the container
        colorImagesContainer.appendChild(colorDiv);
    }

    function UndoLastInput() {
        var colorImagesContainer = document.getElementById('color-images-container');
        var lastInput = colorImagesContainer.lastElementChild;
        if (lastInput) {
            colorImagesContainer.removeChild(lastInput);
        } else {
            alert("No inputs to undo!");
        }
    }

</script>
@endsection