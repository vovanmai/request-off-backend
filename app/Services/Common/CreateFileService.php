<?php

namespace App\Services\Common;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateFileService
{

    /**
     * @param array $data
     * @return File
     */
    public function handle(array $data)
    {
        $file = $data['file'];

        $fileParams = $this->getFileParams($file);

        Storage::disk('public')->putFileAs($fileParams['path'], $file, $fileParams['filename']);

        return File::create($fileParams);
    }

    /**
     * @param UploadedFile $file UploadedFile
     * @return array
     */
    public function getFileParams(UploadedFile $file): array
    {
        return [
            'extension' => $file->getClientOriginalExtension(),
            'byte_size' => $file->getSize(),
            'content_type' => $file->getClientMimeType(),
            'filename' => $file->getClientOriginalName(),
            'path' => 'uploads/' . Str::orderedUuid()->toString(),
        ];
    }
}
