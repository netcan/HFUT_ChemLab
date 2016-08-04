<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index')->with('categories', Category::withCount('articles')->get());
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if($category->articles->count() != 0)
            abort(403);
        else if(in_array($category->name, Category::$base))
            return redirect()->back()->withErrors('系统分类，无法删除！');
        else
            $category->delete();
        return redirect()->back();
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name',
        ]);

        if (Category::create([
            'name' => $request->get('name'),
        ])
        )
            return redirect('admin/resources/categories');
        else
            return redirect()->back()->withInput()->withErrors('新建失败！');
    }

    public function edit($id)
    {
        if($category = Category::find($id))
            return view('admin.categories.edit')->with('category', $category);
        else
            abort(404);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name',
        ]);

        $category = Category::find($id);
        $category->name = $request->get('name');
        if($category->save())
            return redirect('admin/resources/categories');
        else
            return redirect()->back()->withInput()->withErrors('更新失败！');
        //
    }
}
