<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeRequest;
use App\Http\Resources\AttributeResource;
use App\Models\Attribute;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return AttributeResource::collection(
            Attribute::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AttributeRequest $request
     * @return AttributeResource
     */
    public function store(AttributeRequest $request)
    {
        $attribute = Attribute::query()->create($request->validated());
        return AttributeResource::make($attribute);
    }

    /**
     * Display the specified resource.
     *
     * @param Attribute $attribute
     * @return AttributeResource
     */
    public function show(Attribute $attribute)
    {
        return AttributeResource::make($attribute);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AttributeRequest $request
     * @param Attribute $attribute
     * @return AttributeResource
     */
    public function update(AttributeRequest $request, Attribute $attribute)
    {
        $attribute->update($request->validated());
        return AttributeResource::make($attribute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Attribute $attribute
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return response(null, 204);
    }
}
