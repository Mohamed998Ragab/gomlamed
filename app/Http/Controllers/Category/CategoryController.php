<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ImageHandler;
    public function index()
    {
        $categories = Category::paginate(6);

        return view('admin.category.category')->with(compact('categories'));
    }

    public function addPage()
    {
        return view('admin.category.add');
    }

    public function store(StoreRequest $request) 
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->saveImage($request->file('image'));
        }

        Category::create($data);
        return redirect('admin/category')->with('success', 'Category created successfully!');
    }

    public function editPage($id)
    {
        $category = Category::find($id);

        // Handle the case where the slider does not exist
        if (!$category) {
            return redirect('admin/category')->with('error', 'Category not found.');
        }

        return view('admin.category.edit', compact('category'));

    }

    public function update($id, UpdateRequest $request)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect('admin/category')->with('error', 'Category not found.');
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {

            $this->deleteImage($category->image);

            $data['image'] = $this->saveImage($request->file('image'));
        }

        $category->update($data);

        return redirect('admin/category')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect('admin/category')->with('error', 'Category not found.');
        }

        if ($category->image) {
            $this->deleteImage($category->image);
        }

        $category->delete();

        return redirect('admin/category')->with('success', 'Category deleted successfully!');

    }
}
