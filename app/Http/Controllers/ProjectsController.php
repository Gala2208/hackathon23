<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show(Request $request)
    {
        try {
            $isValidationStatus = $request->validate([
                'id' => ['required']
            ]);
            if ($isValidationStatus) $projects = Project::where('id', $request->id)->get();
            return response((count($projects) > 0) ? $projects[0] : "not found");
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
                'descr' => ['string'],
                'img' => ['string']
            ]);
            if ($isValidationStatus) {
                $isStatusCreated = Project::create([
                    'name' => $request->name,
                    'descr' => $request->descr,
                    'img' => $request->img,
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
    public function index()
    {
        return response(Project::all());
    }
}
