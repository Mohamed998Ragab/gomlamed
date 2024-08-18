<?php

namespace App\Http\Controllers\ThirdBanner;

use App\Http\Controllers\Controller;
use App\Http\Requests\ThirdBanner\StoreRequest;
use App\Http\Requests\ThirdBanner\UpdateRequest;
use App\Models\ThirdBanner;
use Illuminate\Http\Request;

class ThirdBannerController extends Controller
{
    public function index()
    {
        $banners = ThirdBanner::paginate(6);

        return view('admin.thirdBanner.banner')->with(compact('banners'));
    }

    public function addPage()
    {
        return view('admin.thirdBanner.add');
    }

    public function store(StoreRequest $request) 
    {
        $data = $request->validated();
        ThirdBanner::create($data);
        return redirect('admin/thirdBanner')->with('success', 'Banner created successfully!');
    }

    public function editPage($id)
    {
        $banner = ThirdBanner::find($id);

        // Handle the case where the slider does not exist
        if (!$banner) {
            return redirect('admin/thirdBanner')->with('error', 'Banner not found.');
        }

        return view('admin.thirdBanner.edit', compact('banner'));

    }

    public function update($id, UpdateRequest $request)
    {
        $banner = ThirdBanner::find($id);

        if (!$banner) {
            return redirect('admin/thirdBanner')->with('error', 'Banner not found.');
        }

        $data = $request->validated();
        $banner->update($data);

        return redirect('admin/thirdBanner')->with('success', 'Banner updated successfully!');
    }

    public function destroy($id)
    {
        $banner = ThirdBanner::find($id);
        
        if (!$banner) {
            return redirect('admin/thirdBanner')->with('error', 'Banner not found.');
        }

        $banner->delete();
        return redirect('admin/thirdBanner')->with('success', 'Banner deleted successfully!');

    }
}
