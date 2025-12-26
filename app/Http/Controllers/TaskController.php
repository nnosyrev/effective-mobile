<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\Request;

final readonly class TaskController extends Controller
{
    public function __construct(private TaskService $taskService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = $this->taskService->findAll();

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
