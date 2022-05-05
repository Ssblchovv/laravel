<?php

namespace App\Http\Controllers\OpenApi;

use OpenApi\Attributes as OA;

class FileController
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
                    default: '/images/examples.jpg'
                ),
            ],
            type: 'object'
        )
    )]
    public function upload()
    {

    }
}
