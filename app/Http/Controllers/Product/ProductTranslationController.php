<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreTranslationRequest;
use App\Http\Requests\Product\UpdateTranslationRequest;
use App\Models\Language;
use App\Models\ProductTranslation;
use Illuminate\Http\Request;

class ProductTranslationController extends Controller
{
    public function index($productId)
    {
        $translations = ProductTranslation::where('product_id', $productId)->with('language')->paginate(10);
        // dd($translations);
        return view('admin.product.translation.translation', compact('translations', 'productId'));
    }

    public function create($productId)
    {
        $languages = Language::all();
        
        return view('admin.product.translation.add', compact('languages', 'productId'));
    }

    public function store(StoreTranslationRequest $request, $productId)
    {
        $data = $request->validated();
        $data['product_id'] = $productId;

        ProductTranslation::create($data);

        return redirect()->route('products.translations.index', $productId)->with('success', 'Translation added successfully!');
    }

    public function edit($productId, $id)
    {
        $translation = ProductTranslation::findOrFail($id);
        $languages = Language::all();

        return view('admin.product.translation.edit', compact('translation', 'languages', 'productId'));
    }

    public function update(UpdateTranslationRequest $request, $productId, $id)
    {
        $translation = ProductTranslation::findOrFail($id);
        $data = $request->validated();

        $translation->update($data);

        return redirect()->route('products.translations.index', $productId)->with('success', 'Translation updated successfully!');
    }

    public function destroy($productId, $id)
    {
        $translation = ProductTranslation::findOrFail($id);
        $translation->delete();

        return redirect()->route('products.translations.index', $productId)->with('success', 'Translation deleted successfully!');
    }
}
