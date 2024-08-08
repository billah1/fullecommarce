<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RequestUploadLogo;
use App\Models\Logo;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function logo(Request $request): View|Application|Factory
    {
        $perPage = request()->input('perPage', 12);
        $logos = Logo::orderBy('id', 'desc')->paginate($perPage);
        return view('Admin.pages.settings.logo', ['title' => 'Settings', 'logos' => $logos]);
    }

    public function uploadLogo(RequestUploadLogo $request): RedirectResponse
    {
        try {
            $logo = $request->file('file');
            $path = uploadImage($logo);

            Logo::create([
                'logo' => $path,
            ]);
        }catch (Exception $exception) {
            dd($exception->getMessage());
        }

        return back();
    }

    public function updateIsActive($id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $logo = Logo::whereId($id)->first()->update([
                'is_active' => true,
            ]);
            $changeValue = Logo::where('id', '!=', $id)->get();
            foreach ($changeValue as $value) {
                $value->update([
                    'is_active' => false,
                ]);
            }
            DB::commit();
        }catch (Exception $exception) {
            DB::rollBack();
        }
        return response()->json(['message' => 'is_active updated successfully']);
    }
}
