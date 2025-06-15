<?php

namespace App\Http\Controllers;

use App\Domain\Places\Services\PlaceService;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlaceController extends AbstractController
{
    protected $service;

    public function __construct(PlaceService $service)
    {
        $this->service = $service;
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:places,slug',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
        ]);

        // Generate slug from name if not provided
        if (!$request->has('slug') || empty($request->slug)) {
            $request->merge(['slug' => Str::slug($request->name)]);
        }

        return response()->json($this->service->create($request->all()));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:places,slug',
            'country' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
        ]);

        // Generate slug from name if name is provided and slug is not
        if ($request->has('name') && (!$request->has('slug') || empty($request->slug))) {
            $request->merge(['slug' => Str::slug($request->name)]);
        }

        return response()->json($this->service->update($id, $request->all()));
    }
}
