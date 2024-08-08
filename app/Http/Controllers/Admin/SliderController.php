<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function showAllSlider(): View|Application|Factory
    {
        $items = Slider::paginate(9);

        return view('Admin.pages.slider.list', ['items' => $items, 'title' => 'Slider']);
    }

    public function sliderStore(Request $request): RedirectResponse
    {
//        dd($request->input());
        try {
            $image = $request->file('file');
            $path = uploadImage($image, 'admin/slider');
            $status = request('status', 'off');
            Slider::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $path,
                'is_active' => ($status === 'on') ? true : false
            ]);
        } catch (Exception $exception) {
            toastr()->Error('Something Went Wrong!!!');
        }
        toastr()->Success('You have successfully created a new Slider!!!');

        return back();
    }

    public function edit(Request $request, Slider $slider): RedirectResponse
    {
        try {
            $image = $request->file('file');
            if ($image) {
                $path = uploadImage($image, 'admin/slider');
                $slider->update(['image' => $path]);
            }
            $status = request('status', 'off');
            $slider->update([
                'title' => $request->title,
                'description' => $request->description,
                'is_active' => ($status === 'on') ? true : false
            ]);
        } catch (Exception $exception) {
            toastr()->Error('Something Went Wrong!!!');
        }
        toastr()->Success('You have successfully updated the Slider!!!');
        return back();
    }

    public function toggle(Request $request, Slider $slider): JsonResponse
    {
        try {
            $status = (bool)$request->input('status');
            $slider->update(['is_active' => $status]);
            $data = ['message' => 'Success! status updated', 'is_active' => $slider->is_active, 'id' => $slider->id];
        } catch (Exception $exception) {
            $data['message'] = 'Sorry! something went wrong';

            return response()->json($data, $status = 500);
        }

        return response()->json($data);
    }
    public function delete(Slider $slider)
    {
        try {
            $slider->delete();
        }catch (Exception $exception) {
            toastr()->Error('Something Went Wrong!!!');
        }
        toastr()->Success('You have successfully deleted the Slider!!!');
        return back();
    }
}
