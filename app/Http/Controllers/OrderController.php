<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\product;
use App\Models\ProductVariants;
use App\Models\Region;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    //chechkout
    public function chechkOut()
    {
        $user = null;
        $subTotal = 0;
        $total = 0;
        if (Auth::check()) {
            $user = Auth::user();
            $carts = Cart::with('product')->where('user_id', $user->id)->get();
            session()->put('carts', $carts);
            foreach ($carts as $cart) {
                // $subTotal += $cart->product->price * $cart->quantity;
                // $total += $subTotal;
                $total += $cart->product->price * $cart->quantity;
            }
        } else {
            $guestId = session()->get('guest_id');
            $carts = Cart::with('product')->where('guest_id', $guestId)->get();
            session()->put('carts', $carts);
            foreach ($carts as $cart) {
                // $subTotal += $cart->product->price * $cart->quantity;
                // $total += $subTotal;
                $total += $cart->product->price * $cart->quantity;
            }
        }
        // dd($total);
        $cities = City::has('shippings')->get();
        return view('user.chechkOut', compact('carts', 'total', 'user', 'cities'));
    }

    function order(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required',
            'phoneNumber' => 'required',
            'secondPhoneNumber' => 'string',
            'address' => 'required',
            // 'country' => 'required',
            // 'city' => 'required',
            'shipping_id' => "required",
        ]);
        // dd($request);
        if (!Auth::check()) {
            $data = $request->validate([
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ]);

            $password = Hash::make($request->password);

            $user = User::create([
                "name" => $request->name,
                'email' => $request->email,
                'password' => $password,
                'phoneNumber' => $request->phoneNumber,
                'secondPhoneNumber' => $request->secondPhoneNumber
            ]);

            Auth::login($user);
            $carts = session()->get('carts');
        } else {
            $user = User::updateOrCreate(
                ['id' => Auth::id()],
                [
                    'phoneNumber' => $request->phoneNumber,
                    'secondPhoneNumber' => $request->secondPhoneNumber,
                ]
            );
            $carts = session()->get('carts');
        }
        
        $shipping = Shipping::find($request->shipping_id);
        $shippingPrice = $shipping->price;
        $total = $request->total + $shippingPrice;
        $order = Order::create([
            'user_id' => $user->id,
            'adress' => $request->address,
            'shipping_id' => $request->shipping_id,
            'sub_total' => $request->total,
            'total' => $total,
        ]);

        foreach ($carts as $item) {
            $variant = ProductVariants::find($item->product_variant_id,);
            if (!$variant) {
                $order->delete();
                return redirect()->back()->with('error', 'Product variant not found!');
            }
        
            $availableQuantity = $variant->availableQuantity();
        
            $requestedQuantity = $request->quantity;
        
            if ($requestedQuantity > $availableQuantity) {
                $order->delete();
                return redirect()->back()->with('error', 'Sorry, only ' . $availableQuantity . ' left in stock.');
            }

            $price = $item->product->price * $item->quantity;
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_variant_id' => $item->product_variant_id,
                'quantity' => $item->quantity,
                'price' => $price,
            ]);
            $cart = Cart::find($item->id);
            $cart->delete();
        }
        session()->forget('carts');
        $products = product::all();
        Session::flash('orderStatus', 'order placed succusfully ');
        return view('user.allProducts')->with('products', $products);
    }

    function placeUserOrder()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        foreach ($orders as $order) {
            $orderItems = OrderItem::where('order_id', $order->id)->get();
        }

        return view('user.orders', compact('orders', 'orderItems'));
    }

    function orders(Request $request)
    {
        $userId = $request->session()->get('user')['id'];
        $orderItem = $request->session()->get('user')['id'];
        // $products = product::all();
        $products = DB::table('orders')->where('user_id', $userId)->get();
        // $Orderitems = DB::table('order_items')->where('order_id', $products->order_id)->get();
        return view('user.orders')->with('products', $products);
    }
    function deleteOrder(Request $request)
    {
        $orderId = $request->id;
        DB::table('orders')->where('id', '=', "$orderId")->delete();
        $products = product::all();

        return view('user.allProducts', compact('products'))->with('message', 'order deleted succfuly');
        // return $orderId;
    }


    //admin order
    function viewOrder($id)
    {
        $orderId = $id;
        $order = Order::find($orderId);
        $orderItems = OrderItem::where('order_id', $orderId)->get();

        return view('admin.veiwOrder', compact('orderItems', 'order'));
    }
    function adminOrders()
    {
        $orders = Order::all();
        return view('admin.order', compact('orders'));
    }
    function editOrder($id)
    {
        $orders = Order::findOrFail($id);

        return view('admin.orderEdit', compact('orders'));
    }
    function updateOrder(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'string',
        ]);
        $orders = Order::findOrFail($id);
        $orders->update($data);
        return redirect('adminOrders')->with('success', 'data updated succfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->update([
                'status' => $request->status,
            ]);

            return redirect()->back();
        }
    }
}
