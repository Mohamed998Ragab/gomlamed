<?php

namespace App\Http\Controllers\ThirdBanner;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThirdBanner\StoreTranslationRequest;
use App\Http\Requests\ThirdBanner\UpdateTranslationRequest;
use App\Models\Language;
use App\Models\ThirdBannerTranslation;
use Illuminate\Http\Request;

class ThirdBannerTranslationController extends Controller
{
    public function index($thirdBannerId)
    {
        $translations = ThirdBannerTranslation::where('third_banner_id', $thirdBannerId)->with('language')->paginate(10);
        // dd($translations);
        return view('admin.thirdBanner.translation.translation', compact('translations', 'thirdBannerId'));
    }

    public function create($thirdBannerId)
    {
        $languages = Language::all();
        
        return view('admin.thirdBanner.translation.add', compact('languages', 'thirdBannerId'));
    }

    public function store(StoreTranslationRequest $request, $thirdBannerId)
    {
        $data = $request->validated();
        $data['third_banner_id'] = $thirdBannerId;

        ThirdBannerTranslation::create($data);

        return redirect()->route('thirdBanners.translations.index', $thirdBannerId)->with('success', 'Translation added successfully!');
    }

    public function edit($thirdBannerId, $id)
    {
        $translation = ThirdBannerTranslation::findOrFail($id);
        $languages = Language::all();

        return view('admin.thirdBanner.translation.edit', compact('translation', 'languages', 'thirdBannerId'));
    }

    public function update(UpdateTranslationRequest $request, $thirdBannerId, $id)
    {
        $translation = ThirdBannerTranslation::findOrFail($id);
        $data = $request->validated();

        $translation->update($data);

        return redirect()->route('thirdBanners.translations.index', $thirdBannerId)->with('success', 'Translation updated successfully!');
    }

    public function destroy($thirdBannerId, $id)
    {
        $translation = ThirdBannerTranslation::findOrFail($id);
        $translation->delete();

        return redirect()->route('thirdBanners.translations.index', $thirdBannerId)->with('success', 'Translation deleted successfully!');
    }
}
