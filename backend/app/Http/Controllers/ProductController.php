<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product as RequestsProduct;
use App\Models\Product;;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Throwable;

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

        if($request->hasFile('image')){
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = url('storage/'.$path);
        }

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

        if($request->hasFile('image')){
            try{
                $image_name = explode('products/', $product->image);
                Storage::disk('public')->delete('products/'. $image_name[1]);

            }catch(Throwable){

            }finally{
                $path = $request->file('image')->store('products', 'public');
                $data['image'] = url('storage/'.$path);
            }
        }

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
