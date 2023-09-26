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
                'img' => ['string'],
                'count' => ['int'],
            ]);
            if ($isValidationStatus) {
                $isStatusCreated = Material::create([
                    'name' => $request->name,
                    'img' => $request->img ?? '',
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

    public function update(Request $request)
    {
        try {
            if ($request->validate([
                'id' => ['required', 'int'],
                'fields' => ['required', 'array']
            ])) {
                $attr = [];
                foreach($request->fields as $key => $value) $attr[$key] = $value;
                Material::where('id', $request->id)->update($attr);
                return response(['status' => true]);
            }
            return response(['status' => false]);
        } catch(\Exception $e) {
            return response([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
