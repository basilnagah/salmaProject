<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class sizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();

        if($sizes)
        {
            return view('admin.size.index',compact('sizes'));
        }
        
    }

    public function create()
    {
        return view('admin.size.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "sizeName" =>"required"
        ]);

        size::create([
            'name'=> $request->sizeName,
        ]);

        return redirect(route('size.create'))->with('success', 'size Created ssuccessfully');

    }

    public function edit($id)
    {
        $size = size::where('id',$id)->first();

        if($size)
        {
            return view('admin.size.edit',compact('size'));
        }
        return redirect(route('size.index'))->with('error',"size Not Found");
    }

    public function update(Request $request)
    {
        $request->validate([
            "sizeName" =>"required",
            'id' =>"required"
        ]);

        $size = size::where('id',$request->id)->first();

        if($size)
        {
            $size->update([
                "name"=>$request->sizeName,
            ]);
            return redirect(route('size.index'))->with('success',"size Updated successfully");
        }
        return redirect(route('size.index'))->with('error',"size Not Found");

    }

    public function delete($id)
    {
        $size = size::where('id',$id)->first();

        if($size)
        {
            $size->delete();

            return redirect(route('size.index'))->with('success',"size deleted successfully");
        }
        return redirect(route('size.index'))->with('error',"size Not Found");

    }
}
