<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            [
                "id" => 1,
                "title" => "Post Title 1",
                "content" => "Post Content 1"
            ],
            [
                "id" => 2,
                "title" => "Post Title 2",
                "content" => "Post Content 2"
            ],
            [
                "id" => 3,
                "title" => "Post Title 3",
                "content" => "Post Content 3"
            ]
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // $data = $request->all();
        // $data = $request->only(['title', 'body']);
        // return $data;

        return response()->json(
            [
                "message" => "Post created successfully",
                "data" => [
                    "id" => 12,
                    "title" => $request->title,
                    "content" => $request->body
                ]
            ]
        )
        ->header("Content-Type", "application/json")
        ->setStatusCode(201)
        ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return [
        //     "message" => "test",
        //     "data" => [
        //         "id" => $id,
        //         "title" => "Post Title",
        //         "content" => "Post Content"
        //     ]
        // ];

        return response()->json([
            "message" => "test",
            "data" => [
                "id" => $id,
                "title" => "Post Title",
                "content" => "Post Content"
            ]
        ])
        ->header('Test-Header', 'TestValue') // header for additional information in response
        ->header('Content-Type', 'application/json') // set content type to json
        ->setStatusCode(200) // set status code to 200 OK
        ; 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            "title" => "required|string|max:255",
            "content" => "required|string"
        ]);

        // $data = $request->all();

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // return response()->json([
        //     "message" => "Post deleted successfully"
        // ], 200);

        return response()->noContent(); // return 204 No Content status code
    }
}
