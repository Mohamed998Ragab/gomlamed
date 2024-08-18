<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\SliderRequest;
use App\Http\Requests\Slider\UpdateRequest;
use App\Models\Slider;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ImageHandler;
    public function index()
    {
        $sliders = Slider::paginate(6);

        return view('admin.slider.slider')->with(compact('sliders'));
    }

    public function addPage()
    {
        return view('admin.slider.add');
    }

    public function store(SliderRequest $request) 
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->saveImage($request->file('image'));
        }

        Slider::create($data);
        return redirect('admin/slider')->with('success', 'Slider created successfully!');
    }

    public function editPage($id)
    {
        $slider = Slider::find($id);

        // Handle the case where the slider does not exist
        if (!$slider) {
            return redirect('admin/slider')->with('error', 'Slider not found.');
        }

        return view('admin.slider.edit', compact('slider'));

    }

    public function update($id, UpdateRequest $request)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            return redirect('admin/slider')->with('error', 'Slider not found.');
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {

            $this->deleteImage($slider->image);

            $data['image'] = $this->saveImage($request->file('image'));
        }

        $slider->update($data);

        return redirect('admin/slider')->with('success', 'Slider updated successfully!');
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            return redirect('admin/slider')->with('error', 'Slider not found.');
        }

        if ($slider->image) {
            $this->deleteImage($slider->image);
        }

        $slider->delete();

        return redirect('admin/slider')->with('success', 'Slider deleted successfully!');

    }


}
