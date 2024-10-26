<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product as RequestsProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private $products;

    function __construct(Product $products){
        $this->products = $products;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $product = $this->products->all();
        return response()->json($product, Response::HTTP_OK);
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
    public function store(RequestsProduct $request): JsonResponse
    {
        $data = $request->validated();
        $product =$this->products->create($data);
        return response()->json($product, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $product = $this->products->findOrFail($id);
        return response()->json($product, Response::HTTP_OK);
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
    public function update(RequestsProduct $request, string $id): JsonResponse
    {
        $data = $request->validated();
        $product = $this->products->findOrFail($id);
        $product->update($data);
        return response()->json($product, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = $this->products->findOrFail($id);
        $product->delete();
        return response()->json($product, Response::HTTP_OK);
    }
}
