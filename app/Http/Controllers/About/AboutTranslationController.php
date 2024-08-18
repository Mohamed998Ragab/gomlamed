<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use App\Http\Requests\About\StoreTranslationRequest;
use App\Http\Requests\About\UpdateTranslationRequest;
use App\Models\AboutTranslation;
use App\Models\Language;
use Illuminate\Http\Request;

class AboutTranslationController extends Controller
{
    public function index($aboutId)
    {
        $translations = AboutTranslation::where('about_id', $aboutId)->with('language')->paginate(10);
        // dd($translations);
        return view('admin.about.translation.translation', compact('translations', 'aboutId'));
    }

    public function create($aboutId)
    {
        $languages = Language::all();
        
        return view('admin.about.translation.add', compact('languages', 'aboutId'));
    }

    public function store(StoreTranslationRequest $request, $aboutId)
    {
        $data = $request->validated();
        $data['about_id'] = $aboutId;

        AboutTranslation::create($data);

        return redirect()->route('abouts.translations.index', $aboutId)->with('success', 'Translation added successfully!');
    }

    public function edit($aboutId, $id)
    {
        $translation = AboutTranslation::findOrFail($id);
        $languages = Language::all();

        return view('admin.about.translation.edit', compact('translation', 'languages', 'aboutId'));
    }

    public function update(UpdateTranslationRequest $request, $aboutId, $id)
    {
        $translation = AboutTranslation::findOrFail($id);
        $data = $request->validated();

        $translation->update($data);

        return redirect()->route('abouts.translations.index', $aboutId)->with('success', 'Translation updated successfully!');
    }

    public function destroy($aboutId, $id)
    {
        $translation = AboutTranslation::findOrFail($id);
        $translation->delete();

        return redirect()->route('abouts.translations.index', $aboutId)->with('success', 'Translation deleted successfully!');
    }
}
