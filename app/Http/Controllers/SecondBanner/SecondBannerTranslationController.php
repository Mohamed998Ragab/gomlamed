<?php

namespace App\Http\Controllers\SecondBanner;

use App\Http\Controllers\Controller;
use App\Http\Requests\SecondBanner\StoreTranslationRequest;
use App\Http\Requests\SecondBanner\UpdateTranslationRequest;
use App\Models\Language;
use App\Models\SecondBannerTransaltion;
use Illuminate\Http\Request;

class SecondBannerTranslationController extends Controller
{
    public function index($secondBannerId)
    {
        $translations = SecondBannerTransaltion::where('second_banner_id', $secondBannerId)->with('language')->paginate(10);
        // dd($translations);
        return view('admin.secondBanner.translation.translation', compact('translations', 'secondBannerId'));
    }

    public function create($secondBannerId)
    {
        $languages = Language::all();
        
        return view('admin.secondBanner.translation.add', compact('languages', 'secondBannerId'));
    }

    public function store(StoreTranslationRequest $request, $secondBannerId)
    {
        $data = $request->validated();
        $data['second_banner_id'] = $secondBannerId;

        SecondBannerTransaltion::create($data);

        return redirect()->route('secondBanners.translations.index', $secondBannerId)->with('success', 'Translation added successfully!');
    }

    public function edit($secondBannerId, $id)
    {
        $translation = SecondBannerTransaltion::findOrFail($id);
        $languages = Language::all();

        return view('admin.secondBanner.translation.edit', compact('translation', 'languages', 'secondBannerId'));
    }

    public function update(UpdateTranslationRequest $request, $secondBannerId, $id)
    {
        $translation = SecondBannerTransaltion::findOrFail($id);
        $data = $request->validated();

        $translation->update($data);

        return redirect()->route('secondBanners.translations.index', $secondBannerId)->with('success', 'Translation updated successfully!');
    }

    public function destroy($secondBannerId, $id)
    {
        $translation = SecondBannerTransaltion::findOrFail($id);
        $translation->delete();

        return redirect()->route('secondBanners.translations.index', $secondBannerId)->with('success', 'Translation deleted successfully!');
    }
}
