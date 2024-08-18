<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\TopProduct;
use App\Traits\ImageHandler;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ImageHandler;
    public function index()
    {
        $products = Product::with(['category.englishTranslation'])->paginate(6);
        // dd($products);
        return view('admin.product.product')->with(compact('products'));
    }

    public function addPage()
    {
        $categories = Category::get();
        return view('admin.product.add')->with(compact('categories'));
    }

    public function store(StoreRequest $request) 
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->saveImage($request->file('image'));
        }

        $data['category_id'] = $request->input('category_id'); // Add this line

        Product::create($data);
        return redirect('admin/product')->with('success', 'Product created successfully!');
    }

    public function editPage($id)
    {
        $product = Product::find($id);
        $categories = Category::get();

        // Handle the case where the product does not exist
        if (!$product) {
            return redirect('admin/product')->with('error', 'Product not found.');
        }

        return view('admin.product.edit', compact('product','categories'));

    }

    public function update($id, UpdateRequest $request)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect('admin/product')->with('error', 'Product not found.');
        }

        $data = $request->validated();

        if ($request->hasFile('image')) {

            $this->deleteImage($product->image);

            $data['image'] = $this->saveImage($request->file('image'));
        }

        $data['category_id'] = $request->input('category_id'); // Add this line

        $product->update($data);

        return redirect('admin/product')->with('success', 'product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect('admin/product')->with('error', 'product not found.');
        }

        if ($product->image) {
            $this->deleteImage($product->image);
        }

        $product->delete();

        return redirect('admin/product')->with('success', 'product deleted successfully!');

    }


    public function search(Request $request)
    {
        $search = $request->input('search');
    
        $products = Product::with(['category.englishTranslation'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('translations', function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');  // Assuming you're searching by product title
                })->orWhereHas('category.translations', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');  // Assuming you're searching by category name
                });
            })
            ->paginate(10);
    
        return view('admin.product.product', compact('products', 'search'));
    }
    
    public function toggleTopProduct($productId)
    {
        $topProduct = TopProduct::where('product_id', $productId)->first();
    
        if ($topProduct) {
            // If it already exists, delete it
            $topProduct->delete();
            return redirect()->back()->with('success', 'Product removed from top products.');
        } else {
            // Otherwise, create it
            TopProduct::create(['product_id' => $productId]);
            return redirect()->back()->with('success', 'Product added to top products.');
        }
    }


    
}
