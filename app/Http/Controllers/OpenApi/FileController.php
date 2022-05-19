<?php

namespace App\Http\Controllers\OpenApi;

use App\Http\Controllers\Controller;
use App\Services\FileUploader\FileUploader;
use Illuminate\Support\Facades\Storage;
use OpenApi\Attributes as OA;
use Illuminate\Http\Request;

class FileController extends Controller
{
    #[OA\Post(
        path: '/upload',
        summary: "upload image",
        tags: ['file'],
    )]
    #[OA\RequestBody(
        description: "Upload images request body",
        required: true,
        content: [
            new OA\MediaType(
                mediaType: "multipart/form-data",
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(
                            property: "file",
                            type: "string",
                            format: "binary"
                        ),
                    ],
                    type: "object",
                )
            )
        ]
    )]
    #[OA\Response(
        response: 200,
        description: 'success',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: "file_url",
                    description: "Url file",
                    format: "string",
                    default: 'http://localhost/images/examples.jpg'
                ),
            ],
            type: 'object'
        )
    )]
    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file',
        ]);

        $file = $request->file('file');

        $timestamp = now()->format('Y-m-d-H-i-s');

        $filename = "{$timestamp}-{$file->getClientOriginalName()}";

        Storage::disk('public')->putFileAs("uploads", $file, $filename);

        return Storage::disk('public')->url("uploads/{$filename}");
    }

    public function upload2(Request $request, FileUploader $fileUploader)
    {
        $this->validate($request, [
            'file' => 'required|file',
        ]);

        $file = $request->file('file');

        $fileName = $fileUploader->upload($file);

        return $fileUploader->generateUrl($fileName);

    }
}
