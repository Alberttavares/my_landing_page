<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post as RequestsPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    private $posts;

    function __construct(Post $posts){
        $this->posts = $posts;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $post = $this->posts->all();
        return response()->json($post, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsPost $request): JsonResponse
    {
        $data = $request->validated();
        $post =$this->posts->create($data);
        return response()->json($post, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $post = $this->posts->findOrFail($id);
        return response()->json($post, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RequestsPost $request, string $id): JsonResponse
    {
        $data = $request->validated();
        $post = $this->posts->findOrFail($id);
        $post->update($data);
        return response()->json($post, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = $this->posts->findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Post deletao com successo!.'], Response::HTTP_OK);
    }
}
