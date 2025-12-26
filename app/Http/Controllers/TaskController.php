<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

final readonly class TaskController extends Controller
{
    public function __construct(private TaskService $taskService) {}

    #[OA\Get(path: '/api/tasks', summary: "Get list of tasks", tags: ['Tasks'])]
    #[OA\Response(
        response: 200,
        description: 'Successful operation',
    )]
    public function index()
    {
        $tasks = $this->taskService->findAll();

        return TaskResource::collection($tasks);
    }

    #[OA\Post(path: '/api/tasks', tags: ['Tasks'], summary: 'Create a task')]
    #[OA\RequestBody(
        required: true,
        description: 'New Task',
        content: new OA\JsonContent(ref: TaskRequest::class)
    )]
    #[OA\Response(
        response: 201,
        description: 'Successful operation',
        content: new OA\JsonContent(ref: TaskResource::class)
    )]
    #[OA\Response(
        response: 422,
        description: 'Error: Unprocessable Content'
    )]
    public function store(TaskRequest $request)
    {
        $task = $this->taskService->create($request);

        return new TaskResource($task);
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
