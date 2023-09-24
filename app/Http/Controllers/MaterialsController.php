<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {    
            return response(Material::all());
        } catch(\Exception $e) {
            return response([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $isValidationStatus = $request->validate([
                'name' => ['required', 'string'],
                'count' => ['int']
            ]);
            if ($isValidationStatus) {
                $isStatusCreated = Material::create([
                    'name' => $request->name,
                    'count' => $request->count ?? 0
                ]);
            }
            if ($isStatusCreated && $isValidationStatus) {
                return response([
                    'status' => true
                ]);
            }
        } catch(\Exception $e) {
            return response([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        try {
            $isValidationStatus = $request->validate([
                'id' => ['required']
            ]);
            if ($isValidationStatus) $projects = Material::where('id', $request->id)->get();
            return response((count($projects) > 0) ? $projects[0] : "not found");
        } catch(\Exception $e) {
            return response([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
