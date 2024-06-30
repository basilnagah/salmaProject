<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class citiesController extends Controller
{
    public function index()
    {
        $Cities = City::all();

        if($Cities)
        {
            return view('admin.City.index',compact('Cities'));
        }
    }

    public function create()
    {
        $countries = Country::all();
        return view('admin.City.create',compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required|string",
            "country_id" => "required"
        ]);

        $city = City::create([
            "name"=>$request->name,
            "country_id" => $request->country_id
        ]);

        if($city)
        {            
            return redirect(route('city.index'))->with('success',"city added successfully");
        }
    }

    public function edit($id)
    {
        $city = City::where('id',$id)->first();
        $countries = Country::all();

        if($city)
        {
            return view('admin.city.edit',compact('city','countries'));
        }
        return redirect(route('city.index'))->with('error',"City Not Found");
    }

    public function update(Request $request)
    {
        $request->validate([
            "name"=>"required|string",
            'id'=>"required",
            "country_id" => "required"
        ]);

        $city = City::where('id',$request->id)->first();

        if($city)
        {
            $city->update([
                "name"=>$request->name,
                "country_id" => $request->country_id
            ]);
            return redirect(route('city.index'))->with('success',"City Updated successfully");
        }
        return redirect(route('city.index'))->with('error',"City Not Found");

    }

    public function delete($id)
    {
        $city = City::where('id',$id)->first();

        if($city)
        {
            $city->delete();

            return redirect(route('city.index'))->with('success',"City deleted successfully");
        }
        return redirect(route('city.index'))->with('error',"City Not Found");

    }
}
