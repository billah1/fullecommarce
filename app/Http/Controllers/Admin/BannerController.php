<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function showBanners()
    {
        $items = Banner::paginate(10);
        return view('Admin.pages.banner.list', ['title' => 'banner', 'items' => $items]);
    }

    public function bannerSave(Request $request)
    {
        try {
            if ($request->file('file')) {
                $image = $request->file('file');
                $path = uploadImage($image, 'admin/Banner');
            }

            $bannerId = $request->input('banner_id', null); // Assuming you add a hidden input for banner ID in the form when editing
            if ($bannerId) {
                // Edit existing banner
                $banner = Banner::findOrFail($bannerId);
                $banner->update([
                    'title' => $request->title,
                    'description' => $request->description,
                ]);
                if ($request->file('file')) {
                    $banner->update([
                        'image' => $path,
                    ]);
                }
                toastr()->Success('Banner updated successfully!');
            } else {
                // Create new banner
                Banner::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $path,
                ]);
                toastr()->Success('New banner created successfully!');
            }

        } catch (\Exception $exception) {
            toastr()->Error('Something went wrong: ' . $exception->getMessage());
            return back();
        }

        return back();
    }

}
