<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use App\Models\Shipping;
use Illuminate\Http\Request;

class shippingController extends Controller
{

    // public function getRegions($cityId)
    // {
    //     $regions = Region::where('city_id', $cityId)->pluck('name', 'id');
    //     return response()->json($regions);
    // }

    public function getRegionsShipping($cityId)
    {
       
        $regions = Shipping::where('shippings.city_id', $cityId)
        ->join('regions', 'shippings.region_id', '=', 'regions.id')
        ->select('regions.id', 'regions.name')
        ->distinct() // Ensure distinct regions
        ->get();

        return response()->json($regions);
    }

    // public function getShippingPrice($regionId)
    // {
    //     $region = Region::find($regionId);
    //     if ($region) {
    //         foreach ($region->shippings as $shippings)
    //         {
    //             $price = $shippings->price; 
    //             $shippingId = $shippings->id;
    //         }

    //         return response()->json(['price' => $price, 'shipping_id' => $shippingId]);
    //     } else {
    //         return response()->json(['error' => 'Region not found'], 404);
    //     }
    // }

    public function getShippingPrice($cityId)
    {
        $city = City::find($cityId);

        if ($city) {
            $shipping = $city->shippings->first(); // Assuming one-to-one relationship between City and Shipping

            // return response()->json($shipping->price) ;
            if ($shipping) {
                $price = $shipping->price;
                $shippingId = $shipping->id;

                return response()->json(['price' => $price, 'shipping_id' => $shippingId]);
            } else {
                return response()->json(['error' => 'Shipping not found for this city'], 404);
            }
        } else {
            return response()->json(['error' => 'City not found'], 404);
        }
    }


    public function index()
    {
        $shippings = Shipping::all();

        return view('admin.Shipping.index',compact('shippings'));
    }

    public function create()
    {
        $countries = Country::all();
        $cities = City::all();
        // $regions = Region::all();
        
        return view('admin.Shipping.create', compact('countries', 'cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "country_id"=>"required|numeric",
            "city_id" => "required|numeric",
            // "region_id" => "required|numeric",
            "price" => "required"
        ]);

        Shipping::create($request->all());

        return redirect()->route('shipping.index')->with('success', 'Shipping created successfully!');
    }

    public function edit($id)
    {
        $shipping = Shipping::where('id',$id)->first();
        $countries = Country::all();
        $cities = City::all();
        // $regions = Region::all();

        if($shipping)
        {
            return view('admin.Shipping.edit',compact('shipping','countries','cities'));
        }
        return redirect(route('region.index'))->with('error',"region Not Found");
    }

    public function update(Request $request)
    {
        $request->validate([
            "country_id"=>"required|numeric",
            "city_id" => "required|numeric",
            // "region_id" => "required|numeric",
            'id' => "required|numeric",
            "price" => "required"
        ]);

        $shipping = Shipping::where('id',$request->id)->first();

        if($shipping)
        {
            $shipping->update([
                "country_id"=> $request->country_id,
                "city_id" => $request->city_id,
                // "region_id" => $request->region_id,
                "price" => $request->price
            ]);
            return redirect(route('shipping.index'))->with('success',"Shipping Updated successfully");
        }
        return redirect(route('shipping.index'))->with('error',"Shipping Not Found");

    }

    public function delete($id)
    {
        $shipping = Shipping::where('id',$id)->first();

        if($shipping)
        {
            $shipping->delete();

            return redirect(route('shipping.index'))->with('success',"Shipping deleted successfully");
        }
        return redirect(route('shipping.index'))->with('error',"Shipping Not Found");

    }
}
