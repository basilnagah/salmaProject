<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Guest;
use App\Models\product;
use App\Models\ProductVariants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class cartController extends Controller
{
    function addToCart(Request $request)
    {
        $product = product::find($request->productId);
        if($product)
        {
            $variant = ProductVariants::find($request->productVariantId);
            if (!$variant) {

                return redirect()->back()->with('error', 'Product variant not found!');
            }
        
            $availableQuantity = $variant->availableQuantity();
        
            $requestedQuantity = $request->quantity;
        
            if ($requestedQuantity > $availableQuantity) {
                return redirect()->back()->with('error', 'Sorry, only ' . $availableQuantity . ' left in stock.');
            }

            if (!auth()->check()) {
                $guestId = session()->get('guest_id');
                if (!$guestId) {
                    // $guestId = Str::uuid('id'); // You can use any method to generate a unique identifier
                    $guestId = rand(); // You can use any method to generate a unique identifier
                    session()->put('guest_id', $guestId);

                    $guest = Guest::create([
                        'guest_id' => $guestId
                    ]);
                }

                $cart = Cart::create([
                    'product_id' => $request->productId,
                    'guest_id' => $guestId,
                    'product_variant_id' => $request->productVariantId,
                    'quantity' => $request->quantity
                ]);

                return redirect()->route('allProducts');
            }
            $userId = Auth::id();

            $cart = Cart::create([
                'product_id' => $request->productId,
                'user_id' => $userId,
                'product_variant_id' => $request->productVariantId,
                'quantity' => $request->quantity
            ]);

            return redirect()->route('allProducts');

        }

        return redirect()->back()->with('error', "product Not Found!");
    }

    function cartList()
    {
        if (!auth()->check()) {
            $guestId = session()->get('guest_id');
            if (!$guestId) {
                return redirect()->route('allProducts');
            }

            $cart = Cart::where('guest_id', $guestId)->get();

            if($cart->isNotEmpty())
            {
                $totalPrice = 0;
                foreach($cart as $item)
                {
                    // dd($item->product_id);
                    $colorId = $item->productVariant->color_id;
                    $totalPrice += $item->product->price * $item->quantity; 

                    $image = $item->productVariant->color->media->where('color_id', $item->productVariant->color_id)->where('mediaable_id', $item->product_id)->first();
                }
                
                return view('user.cartList',compact('cart', 'totalPrice','image'));
            }
            Session::flash('error', 'Your shopping cart is currently empty.');
            return redirect()->route('allProducts');
        }
        else
        {
            $userId = Auth::id();

            $cart = Cart::where('user_id', $userId)->get();

            if($cart->isNotEmpty())
            {
                $totalPrice = 0;
                foreach($cart as $item)
                {
                    // dd($item->product_id);
                    $colorId = $item->productVariant->color_id;
                    $totalPrice += $item->product->price * $item->quantity; 

                    $image = $item->productVariant->color->media
                    ->where('color_id', $item->productVariant->color_id)
                    ->where('mediaable_id', $item->product_id)
                    ->first();
                }
                
                // dd($image);
                return view('user.cartList',compact('cart', 'totalPrice','image'));
            }
            Session::flash('error', 'Your shopping cart is currently empty.');
            return redirect()->route('allProducts');
        }


        // if (Session::has('user')) {

        //     $userId = Session::get('user')['id'];
        //     $products = DB::table('cart')->where('cart.user_id', $userId)->get();
        //     $totalPrice = DB::table('cart')->where('cart.user_id', $userId)->sum('price');
        //     $result = DB::table('cart')
        //         ->where('user_id', $userId)
        //         ->select(DB::raw('SUM(price * quantity)  as Result'))
        //         ->first();
        //     return view('user.cartList')->with('products', $products)->with('result', $result);
        // } else {
        //     $products = product::all();
        //     $time = '4500';
        //     return view('user.allProducts')->with('products', $products)->with('time', $time);
        // }
    }

    function removeCart($id)
    {
        $cart = Cart::find($id);
        if($cart)
        {
            session()->forget('carts');
            $cart->delete();
            $this->cartList();
        }
        return redirect()->back();
    }
}
