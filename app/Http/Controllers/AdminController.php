<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\product;
use App\Models\currncy;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    function curnncy()
    {
        $currncy = currncy::all();
        return view('admin.currncy', compact('currncy'));
    }
    function editCurrncy($id)
    {
        $currncy = currncy::findOrFail($id);

        return view('admin.editCurnncy',compact('currncy'));
    }
    function updateCurnncy( Request $request,$id)
    {
        $data = $request->validate([
            'exchange_rate' => 'string',

        ]);
        $currncy = currncy::findOrFail($id);
        $currncy->update($data);
        // $currncy = currncy::all();
        return redirect(url('curnncy'))->with('success', 'data updated ssuccessfully');
    }

    function categoryFilter($id)
    {
        $products = product::where('category_id',$id)->get();

        return view('user.allProducts',compact('products'));
    }
    
 
    function search(Request $request)
    {
        $key=$request->key;
        $products = product::where('name','like',"%$key%")->get();
        // return $products;
        return view('user.allProducts', compact('products'));
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
        $orderId=$request->id;
        DB::table('orders')->where('id', '=', "$orderId")->delete();
        $products = product::all();

        return view('user.allProducts',compact('products'))->with('message','order deleted succfuly');
        // return $orderId;
    }
    function ergaa()
    {
        return view('user.ergaa');
    }

    function shaan()
    {
        return view('user.shaan');
    }

 
    static function cartItem()
    {
        $userId = Session::get('user')['id'];
        return Cart::where('user_id', $userId)->count();
    }
    
    function cartList()
    {
        if (Session::has('user')) {

            $userId = Session::get('user')['id'];
            $products = DB::table('cart')->where('cart.user_id', $userId)->get();
            $totalPrice = DB::table('cart')->where('cart.user_id', $userId)->sum('price');
            $result = DB::table('cart')
                ->where('user_id', $userId)
                ->select(DB::raw('SUM(price * quantity)  as Result'))
                ->first();
            return view('user.cartList')->with('products', $products)->with('result', $result);
        } else {
            $products = product::all();
            $time = '4500';
            return view('user.allProducts')->with('products', $products)->with('time', $time);
        }
    }

    //chechkout
    function chechkOut()
    {
        $userId = Session::get('user')['id'];
        $products = DB::table('cart')->where('cart.user_id', $userId)->get();
        $totalPrice = DB::table('cart')->where('cart.user_id', $userId)->sum('price');
        $result = DB::table('cart')
            ->where('user_id', $userId)
            ->select(DB::raw('SUM(price * quantity)  as Result'))
            ->first();
        return view('user.chechkOut')->with('products', $products)->with('result', $result);
        // return view('user.chechkOut');
    }
    function order(Request $request)
    {


        $data = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'phoneNumber' => 'required',
            'secondPhoneNumber' => 'string',
            'adress' => 'required',
            'country' => 'required',
            'city' => 'required',
        ]);


        $userId = $request->session()->get('user')['id'];

        $order = new Order;
        $order->firstName = $request->firstName;
        $order->lastName = $request->lastName;
        $order->phoneNumber = $request->phoneNumber;
        $order->secondPhoneNumber = $request->secondPhoneNumber;
        $order->adress = $request->adress;
        $order->country = $request->country;
        $order->city = $request->city;
        $order->user_id = $userId;

        $order->save();

        $cartItem = Cart::where('user_id', $userId)->get();
        foreach ($cartItem as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'name' => $item->name,
                'quantity' => $item->quantity,
                'size' => $item->size,
                'price' => $item->price,
                'image' => $item->image1,
            ]);
        }

        Cart::destroy($cartItem);
        $products = product::all();
        Session::flash('orderStatus', 'order placed succusfully ');
        return view('user.allProducts')->with('products', $products);
    }




   
    function pendingOrder()
    {
        $orders = DB::table('orders')->where('status', 'pending')->get();
        return view('admin.pendingOrder', compact('orders'));
    }
    function deliveredOrder()
    {
        $orders = DB::table('orders')->where('status', 'delivered')->get();
        return view('admin.deliveredOrder', compact('orders'));
    }






    //currency
    function convertCurrnecy(Request $request)
    {
        $products = product::all();
        // return $request->currnecy;
        $currencies = DB::table('currncies')
            ->where('currncy_code', $request->currnecy)
            ->value('exchange_rate');
        $currenciesWord = $request->currnecy;
        $request->session()->pull('currencies', 'correct');
        return view('user.CallProducts')->with('currencies', $currencies)->with('currenciesWord', $currenciesWord)->with('products', $products);
    }
    function convertCurrnecyDet(Request $request, $id)
    {
        $product = product::findOrFail($id);
        $allProducts = product::all();
        // return $request->currnecy;
        $currencies = DB::table('currncies')
            ->where('currncy_code', $request->currnecy)
            ->value('exchange_rate');
        $currenciesWord = $request->currnecy;
        $request->session()->pull('currencies', 'correct');
        return view('user.currncyDet')->with('currencies', $currencies)->with('currenciesWord', $currenciesWord)->with('product', $product)->with('allProducts', $allProducts);
    }
    function convertCurrnecyCart(Request $request)
    {

        if (Session::has('user')) {
            $currencies = DB::table('currncies')
                ->where('currncy_code', $request->currnecy)
                ->value('exchange_rate');
            $currenciesWord = $request->currnecy;
            $userId = Session::get('user')['id'];
            $products = DB::table('cart')->where('cart.user_id', $userId)->get();
            $totalPrice = DB::table('cart')->where('cart.user_id', $userId)->sum('price');
            $result = DB::table('cart')
                ->where('user_id', $userId)
                ->select(DB::raw('SUM(price * quantity)  as Result'))
                ->first();
            return view('user.cartlistCurrn')->with('products', $products)->with('currencies', $currencies)->with('currenciesWord', $currenciesWord)->with('result', $result);
        } else {
            $products = product::all();
            $time = '4500';
            return view('user.allProducts')->with('products', $products)->with('time', $time);
        }
    }
}
