<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function index()
    {
        try {    
            return response(Task::all());
        } catch(\Exception $e) {
            return response([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show(Request $request)
    {
        try {
            $tasks = Task::where('id', $request->id)->get();
            return response( (count($tasks) > 0) ? $tasks[0] : "not found");
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
                'project_id' => ['required', 'int'],
                'type_id' => ['required', 'int'],
                'status_id' => ['required', 'int'],
                'work_name' => ['required', 'string'],
                'prod_name' => ['required', 'string'],
                'units' => ['required', 'string'],
                'count' => ['required', 'int'],
                'supplier_or_performer' => ['required', 'string'],
                'date_of_payment_plan' => ['string'],
                'date_of_payment_fact' => ['string'],
                'date_of_start_plan' => ['string'],
                'date_of_start_fact' => ['string'],
                'date_of_end_plan' => ['string'],
                'date_of_end_fact' => ['string'],
            ]);
            $isStatusCreated = Task::create([
                'project_id' => $request->project_id,
                'type_id' => $request->type_id,
                'status_id' => $request->status_id,
                'work_name' => $request->work_name,
                'prod_name' => $request->prod_name,
                'units' => $request->units,
                'count' => $request->count,
                'supplier_or_performer' => $request->supplier_or_performer,
                'date_of_payment_plan' => $request->date_of_payment_plan ?? null,
                'date_of_payment_fact' => $request->date_of_payment_fact ?? null,
                'date_of_start_plan' => $request->date_of_start_plan ?? null,
                'date_of_start_fact' => $request->date_of_start_fact ?? null,
                'date_of_end_plan' => $request->date_of_end_plan ?? null,
                'date_of_end_fact' => $request->date_of_end_fact ?? null,
            ]);
            if ($isValidationStatus && $isStatusCreated) return response([
                'status' => true
            ]);
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
    public function update(Request $request)
    {
        try {
            if ($request->validate([
                'id' => ['required', 'int'],
                'fields' => ['required', 'array']
            ])) {
                $attr = [];
                foreach($request->fields as $key => $value) $attr[$key] = $value;
                Task::where('id', $request->id)->update($attr);
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
