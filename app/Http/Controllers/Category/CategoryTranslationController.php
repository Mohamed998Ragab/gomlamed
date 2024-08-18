<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreTranslationRequest;
use App\Http\Requests\Category\UpdateTranslationRequest;
use App\Models\CategoryTranslation;
use App\Models\Language;
use Illuminate\Http\Request;

class CategoryTranslationController extends Controller
{
    public function index($categoryId)
    {
        $translations = CategoryTranslation::where('category_id', $categoryId)->with('language')->paginate(10);
        // dd($translations);
        return view('admin.category.transilation.transilation', compact('translations', 'categoryId'));
    }

    public function create($categoryId)
    {
        $languages = Language::all();
        
        return view('admin.category.transilation.add', compact('languages', 'categoryId'));
    }

    public function store(StoreTranslationRequest $request, $categoryId)
    {
        $data = $request->validated();
        $data['category_id'] = $categoryId;

        CategoryTranslation::create($data);

        return redirect()->route('categories.translations.index', $categoryId)->with('success', 'Translation added successfully!');
    }

    public function edit($categoryId, $id)
    {
        $translation = CategoryTranslation::findOrFail($id);
        $languages = Language::all();

        return view('admin.category.transilation.edit', compact('translation', 'languages', 'categoryId'));
    }

    public function update(UpdateTranslationRequest $request, $categoryId, $id)
    {
        $translation = CategoryTranslation::findOrFail($id);
        $data = $request->validated();

        $translation->update($data);

        return redirect()->route('categories.translations.index', $categoryId)->with('success', 'Translation updated successfully!');
    }

    public function destroy($categoryId, $id)
    {
        $translation = CategoryTranslation::findOrFail($id);
        $translation->delete();

        return redirect()->route('categories.translations.index', $categoryId)->with('success', 'Translation deleted successfully!');
    }
}
