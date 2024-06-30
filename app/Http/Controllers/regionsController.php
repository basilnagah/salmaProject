<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;

class regionsController extends Controller
{
    public function index()
    {
        $Regions = Region::all();

        if($Regions)
        {
            return view('admin.Region.index',compact('Regions'));
        }
    }

    public function create()
    {
        $cities = City::all();
        return view('admin.Region.create',compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required|string",
            "city_id" => "required"
        ]);

        $region = Region::create([
            "name"=>$request->name,
            "city_id" => $request->city_id
        ]);

        if($region)
        {            
            return redirect(route('region.index'))->with('success',"region added successfully");
        }
    }

    public function edit($id)
    {
        $region = Region::where('id',$id)->first();
        $cities = City::all();

        if($region)
        {
            return view('admin.Region.edit',compact('region','cities'));
        }
        return redirect(route('region.index'))->with('error',"region Not Found");
    }

    public function update(Request $request)
    {
        $request->validate([
            "name"=>"required|string",
            'id'=>"required",
            "city_id" => "required"
        ]);

        $region = Region::where('id',$request->id)->first();

        if($region)
        {
            $region->update([
                "name"=>$request->name,
                "city_id" => $request->city_id
            ]);
            return redirect(route('region.index'))->with('success',"Region Updated successfully");
        }
        return redirect(route('region.index'))->with('error',"Region Not Found");

    }

    public function delete($id)
    {
        $region = Region::where('id',$id)->first();

        if($region)
        {
            $region->delete();

            return redirect(route('region.index'))->with('success',"Region deleted successfully");
        }
        return redirect(route('region.index'))->with('error',"Region Not Found");

    }
}
