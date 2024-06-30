<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class categoriesController extends Controller
{   
    public function index()
    {
        $categories = Category::all();

        if($categories)
        {
            return view('admin.Category.index',compact('categories'));
        }
    }

    public function navIndex()
    {
        $categories = Category::all();
        dd($categories);
        return view('user.navbar', compact('categories'));
    }

    public function create()
    {
        return view('admin.Category.createCategory');
    }

    public function store(Request $request)
    {
        $request->validate(["name"=>"required|string"]);

        $category = Category::create([
            "name"=>$request->name,
        ]);

        if($category)
        {            
            return redirect(route('category.index'))->with('success',"Category added successfully");
        }
    }

    public function edit($id)
    {
        $category = Category::where('id',$id)->first();

        if($category)
        {
            return view('admin.Category.edit',compact('category'));
        }
        return redirect(route('category.index'))->with('error',"Category Not Found");
    }

    public function update(Request $request)
    {
        $request->validate([
            "name"=>"required|string",
            'id'=>"required"
        ]);

        $category = Category::where('id',$request->id)->first();

        if($category)
        {
            $category->update([
                "name"=>$request->name,
            ]);
            return redirect(route('category.index'))->with('success',"Category Updated successfully");
        }
        return redirect(route('category.index'))->with('error',"Category Not Found");

    }

    public function delete($id)
    {
        $category = Category::where('id',$id)->first();

        if($category)
        {
            $category->delete();

            return redirect(route('category.index'))->with('success',"Category deleted successfully");
        }
        return redirect(route('category.index'))->with('error',"Category Not Found");

    }
}
