<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\color;
use App\Models\Medias;
use App\Models\product;
use App\Models\ProductVariants;
use App\Models\Size;
use App\services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class productController extends Controller
{
    protected $mediaService;
    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    function home()
    {
        // $products=DB::table('products')
        // // ->where('id', '>', '9')
        // ->get();
        $products = product::with('category')->get();
        $result = DB::table('products')
            ->where('sale', 'sale')->get();
        // return $result;
        $categories = Category::get();

        $bestSellinges = product::where('best_selling', 1)->get();
        // dd($products);
        return view('user.home', compact('products'), compact('result', 'categories', 'bestSellinges'));
        // ,compact('result','categories')
    }

    function userAllProducts()
    {
        $products = product::all();

        return view('user.allProducts',compact('products'));
    }

    function productDetail(Request $request ,$id)
    {
        // Load product details with default color and sizes
        $product = Product::findOrFail($id);

        if($request->color_id == null)
        {
           $color =  $product->productVariants->first();
            $defaultProductVariants = $product->productVariants()
            ->where('color_id', $color->color_id)
            // ->with('image')
            ->get();
            $productImages = $product->image()->where('color_id', $color->color_id)->get();
        }
        else{
            $defaultProductVariants = $product->productVariants()
            ->where('color_id', $request->color_id)
            ->get();
            $productImages = $product->image()->where('color_id', $request->color_id)->get();
        }

    
        // Load all available colors for the product
        $availableColors = $product->image()->whereNotNull('color_id')->pluck('color_id')->unique();
        $allProducts = Product::all();

        $relatedProducts = Product::where('category_id',$product->category_id)
        ->where('id', '!=', $product->id)
        ->get();
        
        
        return view('user.productDetail', compact('product', 'defaultProductVariants', 'availableColors', 'allProducts' , 'productImages','relatedProducts'));
    }

    function categoryFilter($id)
    {
        $products = product::where('category_id', $id)->get();

        $categories = Category::get();

        return view('user.categoryFilter', compact('products', 'categories'));
    }

    public function allBestSelling()
    {
        $bestSellinges = product::where('best_selling', 1)->get();

        return view('user.bestSelling', compact('bestSellinges'));
    }

    //admin page
    function allProducts(Request $request)
    {
        $products = product::get();
        $request->session()->forget('currencies');
        return view('admin.all', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        $productVariants = $product->productVariants()->with('size', 'color')->get();
        $productImage = $product->image;
        // return $productImages;?
        if($product)
        {
            return view('admin.show', compact('product','productVariants','productImage'));
        }
    }

    function create()
    {
        $categories = Category::all();
        $colors = color::all();
        $sizes = Size::all();
        return view('admin.create', compact('categories', 'colors', 'sizes'));
    }

    function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required|numeric',
            'salePrice' => '',
            'sale' => '',
            'img.*' => 'required',
            'category_id' => 'required',
            'best_selling' => 'required',
            'sizes' => 'required|array',
            'sizes.*' => 'exists:sizes,id',
            'colors' => 'required|array',
            'colors.*' => 'exists:colors,id',
        ]);


        // Validate quantity inputs
        $quantityRules = [];
        foreach ($request->sizes as $sizeId) {
            foreach ($request->colors as $colorId) {
                $quantityRules["quantity_{$colorId}_{$sizeId}"] = 'nullable|integer|min:0';
            }
        }
        $request->validate($quantityRules);

        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'price' => $request->price,
            'salePrice' => $request->salePrice,
            'sale' => $request->sale,
            'category_id' => $request->category_id,
            'best_selling' => $request->best_selling,
        ]);

        $createdVariants = [];

        foreach ($request->sizes as $sizeId) {
            foreach ($request->colors as $colorId) {
                $quantityKey = 'quantity_' . $colorId . '_' . $sizeId;
                $quantity = $request->input($quantityKey, 0);

                // Check if the variant has already been created
                if (!isset($createdVariants[$colorId][$sizeId])) {
                    // Create the variant
                    ProductVariants::create([
                        'product_id' => $product->id,
                        'color_id' => $colorId,
                        'size_id' => $sizeId,
                        'quantity' => $quantity,
                    ]);

                    // Mark the variant as created
                    $createdVariants[$colorId][$sizeId] = true;
                }
            }
        }

        // Handle image uploads
        foreach ($request->file() as $key => $files) {

            $colorId = explode('_', $key)[1];
            
            // Process the uploaded file(s)
            foreach ($files as $image) {
                // Store or process the image, associating it with the color ID
                $fileName = $this->mediaService->createMedia($image, $product, $colorId);
            }
        }

        return redirect(url('create'))->with('success', 'Data inserted successfully');
    }

    function edit($id)
    {
        $product = product::with('productVariants')->where('id', $id)->first();
        $categories = Category::all();
        $colors = color::all();
        $sizes = Size::all();
        return view('admin.edit', compact('product', 'categories', 'colors', 'sizes'));
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $image = $this->mediaService->deleteProductMedia($product);
            $product->productVariants()->delete();
            $product->delete();
        }
        return redirect(url('productsAll'))->with('success', 'data deleted ssuccessfully');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // dd($request);
        $data = $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required|numeric',
            'sale' => 'nullable|numeric',
            'category_id' => 'required',
            'salePrice' => 'nullable|numeric',
            'best_selling' => 'nullable|boolean',
            'sizes' => 'required|array',
            'sizes.*' => 'exists:sizes,id',
            'colors' => 'required|array',
            'colors.*' => 'exists:colors,id',
        ]);


        // Update product attributes
        $product->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'price' => $request->price,
            'sale' => $request->sale,
            'salePrice' => $request->salePrice,
            'category_id' => $request->category_id,
            'best_selling' => $$request->best_selling ?? false,
        ]);


        // Update product variants
        foreach ($data['sizes'] as $sizeId) {
            foreach ($request->colors as $colorId) {
                $quantityKey = 'quantity_' . $colorId . '_' . $sizeId;
                $quantity = $request->input($quantityKey, 0);

                ProductVariants::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'color_id' => $colorId,
                        'size_id' => $sizeId,
                    ],
                    [
                        'quantity' => $quantity,
                        'color_id' => $colorId,
                        'size_id' => $sizeId,
                    ]
                );
            }
        }


        foreach ($request->file() as $key => $files) {

            $colorId = explode('_', $key)[1];

            // Process the uploaded file(s)
            foreach ($files as $image) {
                // Store or process the image, associating it with the color ID
                $fileName = $this->mediaService->createMedia($image, $product, $colorId);
            }
        }

        // Handle images if needed

        return redirect()->back()->with('success', 'Product updated successfully');
    }

//     public function updateBestSelling($id)
//     {
//         // return "s";
//         $product = product::find($id);
// // dd($product);
//         if($product)
//         {
//             $product->update([
//                 'best_selling' => $product->best_selling
//             ]);

//             return redirect()->back();
//         }
//         return redirect()->back();
//     }

    public function updateBestSelling($id)
    {
        // Retrieve the product by ID
        $product = Product::find($id);

        if($product)
        {
            if($product->best_selling)
            {
                $product->update(["best_selling" => 0]);
            }
            else{
                $product->update(["best_selling" => 1]);
            }
        }

        // Update the status based on the AJAX request
        // $product->best_selling = $request->best_selling; // Assuming you're sending the status in the request

        // Save the changes
        // $product->save();

        // Return a response (if needed)
        return response()->json(['message' => 'Status updated successfully']);
    }
}
