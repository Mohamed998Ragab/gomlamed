<?php

namespace App\Http\Controllers\SecondBanner;

use App\Http\Controllers\Controller;
use App\Http\Requests\SecondBanner\StoreRequest;
use App\Http\Requests\SecondBanner\UpdateRequest;
use App\Models\SecondBanner;
use Illuminate\Http\Request;

class SecondBannerController extends Controller
{
    public function index()
    {
        $banners = SecondBanner::paginate(6);

        return view('admin.secondBanner.banner')->with(compact('banners'));
    }

    public function addPage()
    {
        return view('admin.secondBanner.add');
    }

    public function store(StoreRequest $request) 
    {
        $data = $request->validated();
        SecondBanner::create($data);
        return redirect('admin/secondBanner')->with('success', 'Banner created successfully!');
    }

    public function editPage($id)
    {
        $banner = SecondBanner::find($id);

        // Handle the case where the slider does not exist
        if (!$banner) {
            return redirect('admin/secondBanner')->with('error', 'Banner not found.');
        }

        return view('admin.secondBanner.edit', compact('banner'));

    }

    public function update($id, UpdateRequest $request)
    {
        $banner = SecondBanner::find($id);

        if (!$banner) {
            return redirect('admin/secondBanner')->with('error', 'Banner not found.');
        }

        $data = $request->validated();
        $banner->update($data);

        return redirect('admin/secondBanner')->with('success', 'Banner updated successfully!');
    }

    public function destroy($id)
    {
        $banner = SecondBanner::find($id);
        
        if (!$banner) {
            return redirect('admin/secondBanner')->with('error', 'Banner not found.');
        }

        $banner->delete();
        return redirect('admin/secondBanner')->with('success', 'Banner deleted successfully!');

    }
}
