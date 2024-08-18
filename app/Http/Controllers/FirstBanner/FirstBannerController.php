<?php

namespace App\Http\Controllers\FirstBanner;

use App\Http\Controllers\Controller;
use App\Http\Requests\FirstBanner\StoreRequest;
use App\Http\Requests\FirstBanner\UpdateRequest;
use App\Models\FirstBanner;
use Illuminate\Http\Request;

class FirstBannerController extends Controller
{
    public function index()
    {
        $banners = FirstBanner::paginate(6);

        return view('admin.firstBanner.banner')->with(compact('banners'));
    }

    public function addPage()
    {
        return view('admin.firstBanner.add');
    }

    public function store(Request $request) 
    {
        FirstBanner::create();
        return redirect('admin/firstBanner')->with('success', 'Banner created successfully!');
    }

    public function editPage($id)
    {
        $banner = FirstBanner::find($id);

        // Handle the case where the slider does not exist
        if (!$banner) {
            return redirect('admin/firstBanner')->with('error', 'Banner not found.');
        }

        return view('admin.firstBanner.edit', compact('banner'));

    }

    public function update($id, Request $request)
    {
        $banner = FirstBanner::find($id);

        if (!$banner) {
            return redirect('admin/firstBanner')->with('error', 'Banner not found.');
        }

        $banner->update();

        return redirect('admin/firstBanner')->with('success', 'Banner updated successfully!');
    }

    public function destroy($id)
    {
        $banner = FirstBanner::find($id);

        if (!$banner) {
            return redirect('admin/firstBanner')->with('error', 'Banner not found.');
        }

        $banner->delete();

        return redirect('admin/firstBanner')->with('success', 'Banner deleted successfully!');

    }
}
