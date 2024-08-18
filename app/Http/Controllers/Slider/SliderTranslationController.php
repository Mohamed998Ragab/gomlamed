<?php

namespace App\Http\Controllers\Slider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\StoreTranslationRequest;
use App\Http\Requests\Slider\UpdateTranslationRequest;
use App\Models\Language;
use App\Models\SliderTranslation;
use Illuminate\Http\Request;

class SliderTranslationController extends Controller
{
    public function index($sliderId)
    {
        $translations = SliderTranslation::where('slider_id', $sliderId)->with('language')->paginate(10);
        return view('admin.slider.translation.translation', compact('translations', 'sliderId'));
    }

    public function create($sliderId)
    {
        $languages = Language::all();
        
        return view('admin.slider.translation.add', compact('languages', 'sliderId'));
    }

    public function store(StoreTranslationRequest $request, $sliderId)
    {
        $data = $request->validated();
        $data['slider_id'] = $sliderId;

        SliderTranslation::create($data);

        return redirect()->route('sliders.translations.index', $sliderId)->with('success', 'Translation added successfully!');
    }

    public function edit($sliderId, $id)
    {
        $translation = SliderTranslation::findOrFail($id);
        $languages = Language::all();

        return view('admin.slider.translation.edit', compact('translation', 'languages', 'sliderId'));
    }

    public function update(UpdateTranslationRequest $request, $sliderId, $id)
    {
        $translation = SliderTranslation::findOrFail($id);
        $data = $request->validated();

        $translation->update($data);

        return redirect()->route('sliders.translations.index', $sliderId)->with('success', 'Translation updated successfully!');
    }

    public function destroy($sliderId, $id)
    {
        $translation = SliderTranslation::findOrFail($id);
        $translation->delete();

        return redirect()->route('sliders.translations.index', $sliderId)->with('success', 'Translation deleted successfully!');
    }
}
