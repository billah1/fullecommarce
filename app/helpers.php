<?php

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

function sendSuccessResponse(string $message, int $statusCode = 200, $payload = []): JsonResponse
{
    return response()->json([
        'success' => true,
        'message' => $message,
        'data' => $payload
    ], $statusCode);
}

function sendErrorResponse(string $message, int $statusCode = 200, $payload = []): JsonResponse
{
    return response()->json([
        'success' => false,
        'message' => $message,
        'data' => $payload
    ], $statusCode);
}

function uploadImage(UploadedFile $image, $folder = 'admin/logo', $fileName = null)
{
    $imageCategory = substr($folder, strrpos($folder, '/') + 1);

    if (!$fileName) {
        $fileName = $imageCategory . '_' . time() . '_' . $image->getClientOriginalName();
    }
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }
//    dd($image['filename']['tmp_name']);
    $image->move(public_path($folder), $fileName);
//    move_uploaded_file($image->filename->tmp_name, $folder);
    return $fileName;
}

function upload($model, $request, $input = 'image')
{
//    dd($request->File($input));
    if ($request) {
//        $file = $request->file($input);
        $file_extension = $request->getClientOriginalExtension();
        $isPdf = $file_extension == 'pdf';
        $storage_path = public_path('admin/product');

        # Create folder if not exists
        if (!file_exists($storage_path)) {
            mkdir($storage_path, 0755, true);
        }

        $file_name = uniqid(rand()) . time() . $request->getClientOriginalName();
        if ($isPdf) {
            $request->move($storage_path, $file_name);
            if (!empty($model->$input)) {
                if (File::exists($storage_path . '/' . $model->$input)) {
                    // unlink($storage_path . "/" . $model->$input);
                }
            }
            $model->$input = $file_name;
            $model->save();
        } else {
            $file = Image::make($request);
            $file->save($storage_path . '/' . $file_name);
            if (!empty($model->$input)) {
                if (File::exists($storage_path . '/' . $model->$input)) {
                    unlink($storage_path . '/' . $model->$input);
                }
            }
            $model->$input = $file_name;
            $model->save();
        }
    }
}

function generateProductCode(): int
{
    // Generate a 6-digit random code
    $code = mt_rand(100000, 999999);

    // Check if the code already exists in the database
    while (Product::where('code', $code)->exists()) {
        // If it exists, generate a new code
        $code = mt_rand(100000, 999999);
    }

    return $code;
}

function generateOrderNumber(): string
{
    $date = now();
    $year = $date->year;
    $month = str_pad($date->month, 2, '0', STR_PAD_LEFT);
    $day = str_pad($date->day, 2, '0', STR_PAD_LEFT);

    $sequentialNumber = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

    $orderNumber = "#{$year}{$month}{$day}{$sequentialNumber}";
    while (Order::where('order_code', $orderNumber)->exists()) {
        $sequentialNumber = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $orderNumber = "#{$year}{$month}{$day}{$sequentialNumber}";
    }
    return $orderNumber;
}


