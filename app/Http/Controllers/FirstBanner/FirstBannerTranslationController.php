<?php

namespace App\Http\Controllers\FirstBanner;

use App\Http\Controllers\Controller;
use App\Http\Requests\FirstBanner\StoreTranslationRequest;
use App\Http\Requests\FirstBanner\UpdateTranslationRequest;
use App\Models\FirstBannerTranslation;
use App\Models\Language;
use Illuminate\Http\Request;

class FirstBannerTranslationController extends Controller
{
    public function index($firstBannerId)
    {
        $translations = FirstBannerTranslation::where('first_banner_id', $firstBannerId)->with('language')->paginate(10);
        // dd($translations);
        return view('admin.firstBanner.translation.translation', compact('translations', 'firstBannerId'));
    }

    public function create($firstBannerId)
    {
        $languages = Language::all();
        
        return view('admin.firstBanner.translation.add', compact('languages', 'firstBannerId'));
    }

    public function store(StoreTranslationRequest $request, $firstBannerId)
    {
        $data = $request->validated();
        $data['first_banner_id'] = $firstBannerId;

        FirstBannerTranslation::create($data);

        return redirect()->route('firstBanners.translations.index', $firstBannerId)->with('success', 'Translation added successfully!');
    }

    public function edit($firstBannerId, $id)
    {
        $translation = FirstBannerTranslation::findOrFail($id);
        $languages = Language::all();

        return view('admin.firstBanner.translation.edit', compact('translation', 'languages', 'firstBannerId'));
    }

    public function update(UpdateTranslationRequest $request, $firstBannerId, $id)
    {
        $translation = FirstBannerTranslation::findOrFail($id);
        $data = $request->validated();

        $translation->update($data);

        return redirect()->route('firstBanners.translations.index', $firstBannerId)->with('success', 'Translation updated successfully!');
    }

    public function destroy($firstBannerId, $id)
    {
        $translation = FirstBannerTranslation::findOrFail($id);
        $translation->delete();

        return redirect()->route('firstBanners.translations.index', $firstBannerId)->with('success', 'Translation deleted successfully!');
    }
}
