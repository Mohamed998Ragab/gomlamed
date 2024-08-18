<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use App\Http\Requests\About\StoreRequest;
use App\Http\Requests\About\UpdateRequest;
use App\Models\About;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    use ImageHandler;
    
    public function index()
    {
        $about = About::get()->first();

        return view('admin.about.about')->with(compact('about'));
    }

    public function addPage()
    {
        return view('admin.about.add');
    }

    public function store(StoreRequest $request) 
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->saveImage($request->file('image'));
        }

        About::create($data);
        return redirect('admin/about')->with('success', 'About created successfully!');
    }

    public function editPage($id)
    {
        $about = About::find($id);

        // Handle the case where the slider does not exist
        if (!$about) {
            return redirect('admin/about')->with('error', 'About not found.');
        }

        return view('admin.about.edit', compact('about'));

    }

    public function update($id, UpdateRequest $request)
    {
        $about = About::find($id);

        if (!$about) {
            return redirect('admin/about')->with('error', 'About not found.');
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {

            $this->deleteImage($about->image);

            $data['image'] = $this->saveImage($request->file('image'));
        }

        $about->update($data);

        return redirect('admin/about')->with('success', 'About updated successfully!');
    }

    public function destroy($id)
    {
        $about = About::find($id);

        if (!$about) {
            return redirect('admin/about')->with('error', 'About not found.');
        }

        if ($about->image) {
            $this->deleteImage($about->image);
        }

        $about->delete();

        return redirect('admin/about')->with('success', 'About deleted successfully!');

    }
}
