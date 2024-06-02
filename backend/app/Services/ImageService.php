<?php

namespace App\Services;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function uploadSingleImage(FormRequest $request): string
    {
        $path = '';

        try {
            $path = $request->file('image')->store('images');
        } catch (Exception $exception) {
            Log::info('Image not upload', [
                'message' => $exception,
            ]);
        }

        return $path;
    }

    public function removeImage(string $path): void
    {
        Storage::delete($path);
    }
}
