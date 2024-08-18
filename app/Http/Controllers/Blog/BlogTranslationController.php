<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\StoreTranslationRequest;
use App\Http\Requests\Blog\UpdateTranslationRequest;
use App\Models\BlogTranslation;
use App\Models\Language;
use Illuminate\Http\Request;

class BlogTranslationController extends Controller
{
    public function index($blogId)
    {
        $translations = BlogTranslation::where('blog_id', $blogId)->with('language')->paginate(10);
        // dd($translations);
        return view('admin.blog.translation.translation', compact('translations', 'blogId'));
    }

    public function create($blogId)
    {
        $languages = Language::all();
        
        return view('admin.blog.translation.add', compact('languages', 'blogId'));
    }

    public function store(StoreTranslationRequest $request, $blogId)
    {
        $data = $request->validated();
        $data['blog_id'] = $blogId;

        BlogTranslation::create($data);

        return redirect()->route('blogs.translations.index', $blogId)->with('success', 'Translation added successfully!');
    }

    public function edit($blogId, $id)
    {
        $translation = BlogTranslation::findOrFail($id);
        $languages = Language::all();

        return view('admin.blog.translation.edit', compact('translation', 'languages', 'blogId'));
    }

    public function update(UpdateTranslationRequest $request, $blogId, $id)
    {
        $translation = BlogTranslation::findOrFail($id);
        $data = $request->validated();

        $translation->update($data);

        return redirect()->route('blogs.translations.index', $blogId)->with('success', 'Translation updated successfully!');
    }

    public function destroy($blogId, $id)
    {
        $translation = BlogTranslation::findOrFail($id);
        $translation->delete();

        return redirect()->route('blogs.translations.index', $blogId)->with('success', 'Translation deleted successfully!');
    }
}
