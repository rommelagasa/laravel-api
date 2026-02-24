<?php

namespace App\Http\Controllers\api\v1;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostResource::collection
                (Post::with('author')
                // ->get()
                ->paginate(2)); // eager load author relationship to avoid N+1 problem, wrap in PostResource collection to transform the data
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // $data = $request->all();
        // $data = $request->only(['title', 'body']);
        // return $data;

        $post = $request->validated();

        $post['author_id'] = 1; // hardcoded author_id for testing

        // Save
        $post = Post::create($post);
        return response()->json(new PostResource($post), 201);
    }

    /**
     * Display the specified resource.
     */
    // show(Post $post) => route model binding, automatically find the post by id and inject it into the method
    public function show(Post $post)
    {

        // $post = Post::findOrFail($id);

        return response()->json([
            "message" => "Post retrieved successfully",
            "data" => new PostResource($post)
            ], 200
        );

        // return [
        //     "message" => "test",
        //     "data" => [
        //         "id" => $id,
        //         "title" => "Post Title",
        //         "content" => "Post Content"
        //     ]
        // ];

        // return response()->json([
        //     "message" => "test",
        //     "data" => [
        //         "id" => $id,
        //         "title" => "Post Title",
        //         "content" => "Post Content"
        //     ]
        // ])
        // ->header('Test-Header', 'TestValue') // header for additional information in response
        // ->header('Content-Type', 'application/json') // set content type to json
        // ->setStatusCode(200) // set status code to 200 OK
        // ; 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            "title" => "required|string|max:255",
            "content" => "required|string"
        ]);

        // $data = $request->all();
        $post->update($data);
        return response()->json(new PostResource($post), 200);
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
