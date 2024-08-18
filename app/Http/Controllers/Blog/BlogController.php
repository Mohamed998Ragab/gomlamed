<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\StoreRequest;
use App\Http\Requests\Blog\UpdateRequest;
use App\Models\Blog;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use ImageHandler;
    public function index()
    {
        $blogs = Blog::paginate(6);

        return view('admin.blog.blog')->with(compact('blogs'));
    }

    public function addPage()
    {
        return view('admin.blog.add');
    }

    public function store(StoreRequest $request) 
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->saveImage($request->file('image'));
        }

        Blog::create($data);
        return redirect('admin/blog')->with('success', 'Blog created successfully!');
    }

    public function editPage($id)
    {
        $blog = Blog::find($id);

        // Handle the case where the slider does not exist
        if (!$blog) {
            return redirect('admin/blog')->with('error', 'Blog not found.');
        }

        return view('admin.blog.edit', compact('blog'));

    }

    public function update($id, UpdateRequest $request)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return redirect('admin/blog')->with('error', 'Blog not found.');
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {

            $this->deleteImage($blog->image);

            $data['image'] = $this->saveImage($request->file('image'));
        }

        $blog->update($data);

        return redirect('admin/blog')->with('success', 'Blog updated successfully!');
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return redirect('admin/blog')->with('error', 'Blog not found.');
        }

        if ($blog->image) {
            $this->deleteImage($blog->image);
        }

        $blog->delete();

        return redirect('admin/blog')->with('success', 'Blog deleted successfully!');

    }
}
