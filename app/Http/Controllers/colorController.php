<?php

namespace App\Http\Controllers;

use App\Models\color;
use Illuminate\Http\Request;

class colorController extends Controller
{
    //
    public function index()
    {
        $colors = color::all();

        if($colors)
        {
            return view('admin.color.index',compact('colors'));
        }
        
    }

    public function create()
    {
        return view('admin.color.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "colorName" =>"required",
            "colorCode" => "required"
        ]);

        color::create([
            'name'=> $request->colorName,
            'color_code'=> $request->colorCode,
        ]);

        return redirect(route('color.create'))->with('success', 'Color Created ssuccessfully');

    }

    public function edit($id)
    {
        $color = color::where('id',$id)->first();

        if($color)
        {
            return view('admin.color.edit',compact('color'));
        }
        return redirect(route('color.index'))->with('error',"color Not Found");
    }

    public function update(Request $request)
    {
        $request->validate([
            "colorName" =>"required",
            'id' =>"required",
            'color_code'=> $request->colorCode,
        ]);

        $color = color::where('id',$request->id)->first();

        if($color)
        {
            $color->update([
                "name"=>$request->colorName,
                "color_code" => $request->colorCode
            ]);
            return redirect(route('color.index'))->with('success',"color Updated successfully");
        }
        return redirect(route('color.index'))->with('error',"color Not Found");

    }

    public function delete($id)
    {
        $color = color::where('id',$id)->first();

        if($color)
        {
            $color->delete();

            return redirect(route('color.index'))->with('success',"color deleted successfully");
        }
        return redirect(route('color.index'))->with('error',"color Not Found");

    }
}
