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
      min-height: 100px; 
      overflow-y: auto;
      border: 1px solid #ced4da;
      border-radius: 4px;
      padding: 6px 12px;
  } */

  /* Style for options */
  .multiple-select option {
      padding: 5px;
  }

  /* Style for hover effect */
   .multiple-select option:hover {
      background-color: #f0f0f0;
  } 

 
</style>

@include('admin.success')
@include('admin.errors')
<form method="POST" action="{{url('store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">product Name</label>
      <input type="text" name="name" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
    </div>


    <div class="form-group">
        <label for="exampleInputEmail1">product desc</label>
        <textarea type="text" name="desc" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter desc"></textarea>
      </div>
    {{-- <div class="form-group">
        <label for="exampleInputEmail1">product category</label>
        <textarea type="text" name="category" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter category"></textarea>
      </div> --}}
      <div class="form-group">
        <label for="categorySelect">Product category</label>
        <select name="category_id" class="form-control" id="categorySelect">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option  value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
      </div>


      <div class="form-group">
        <label for="exampleInputEmail1">product Price</label>
        <input type="number" name="price" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">sale</label>
        <input type="text" name="sale" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">price after sale</label>
        <input type="number" name="salePrice" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">
      </div>


      {{-- <div class="form-group">
        <label for="exampleInputEmail1">product quantity</label>
        <input type="text" name="quantity" class="form-control text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price">
      </div> --}}

      <div class="form-group">
        <label for="exampleInputEmail1">Best Selling</label>
        <br>
        <div class="custom-checkbox" id="customCheckbox"></div>
        <input type="hidden" name="best_selling" id="bestSellingValue" value="0">
        <input type="checkbox" name="bestSellingCheckbox" class="form-control checkbox-white">
    </div>

        {{-- <!-- Color and Size selection -->
    <select name="colors[]" class="form-control" multiple>
      <!-- Options for colors -->
    </select>
    <select name="sizes[]" class="form-control" multiple>
      <!-- Options for sizes -->
    </select> --}}

    <!-- Quantity fields for each color and size combination -->
    {{-- <div class="form-group">
      <label for="colors">Colors:</label>
      <select name="colors[]" class="form-control" multiple>
          @foreach($colors as $color)
              <option value="{{ $color->id }}">{{ $color->name }}</option>
          @endforeach
      </select>
  </div> --}}

  <div class="col-md-3 text-end d-grid">
    <button type="button" name="datetime" id="myButton" onclick="AddColorWithImages();"
        class="btn btn-primary">Add Color with Images</button>
  </div>

  <div class="col-md-3 text-end d-grid">
    <button type="button" name="undoButton" id="undoButton" onclick="UndoLastInput();"
        class="btn btn-danger">Undo Last Input</button>
  </div>
  
  <!-- Container for dynamically added color and image upload fields -->
  <div class="form-row mt-3" id="color-images-container">
    <!-- This container will hold dynamically added color and image upload fields -->
  </div>
  
  <br>


  {{-- <div class="form-group">
      <label for="sizes">Sizes:</label>
      <select name="sizes[]" class="form-control" multiple>
          @foreach($sizes as $size)
              <option value="{{ $size->id }}">{{ $size->name }}</option>
          @endforeach
      </select>
  </div> --}}

  <div class="form-group">
    <label for="sizes">Sizes:</label>
    <select name="sizes[]" class="form-control multiple-select" multiple="multiple" id="multiple-select">
      @foreach($sizes as $size)
            <option value="{{ $size->id }}">{{ $size->name }}</option>
        @endforeach
    </select>
</div>



{{-- <div class="col-md-12 mt-3">
  <label for="" class="form-label">Sizes :</label>
  <div class="input-group">
      <select class="form-control multiple-select" id="userId" name="sizes[]" multiple="multiple">

          @foreach($sizes as $user)
              <option  value="{{$size->id}}">{{$size->name}}</option>
          @endforeach
      </select>
  </div> --}}
  
  @foreach($colors as $color)
      @foreach($sizes as $size)
          <div class="form-group">
              <label for="quantity_{{ $color->id }}_{{ $size->id }}">Quantity for {{ $color->name }} - {{ $size->name }}:</label>
              <input type="number" name="quantity_{{ $color->id }}_{{ $size->id }}" class="form-control" value="0" min="0">
          </div>
      @endforeach
  @endforeach

 
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@push('scripts')
  {{-- <script type='text/javascript'>
  console.log(jQuery.fn.jquery);
    $(document).ready(function() {
        $('.multiple-select').select2({
            theme: 'bootstrap4',
            // width: '100%', // Set width explicitly
            placeholder: 'Select Sizes', // Add placeholder text
            // allowClear: true // Allow clearing selectio
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            // placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    
        // Make sure the element with ID 'schedules' exists before calling 'jqs' method
        if ($('#schedules').length > 0) {
            $('#schedules').jqs('export');
        }
    }); --}}

{{-- //   $(document).ready(function() {
//     // Initialize Select2
//     $('.multiple-select').select2({
//         theme: 'bootstrap4',
//         // Other Select2 options...
//     });
// }); --}}


  </script>
@endpush

<script>
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
</script>

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
