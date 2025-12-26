<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\TaskResource;
use App\Services\TaskServiceInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OA;

final readonly class TaskController extends Controller
{
    public function __construct(private TaskServiceInterface $taskService) {}

    #[OA\Get(path: '/api/tasks', summary: "Get list of tasks", tags: ['Tasks'])]
    #[OA\Response(
        response: 200,
        description: 'Successful operation',
    )]
    public function index(): ResourceCollection
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
    public function store(TaskRequest $request): TaskResource
    {
        $task = $this->taskService->create($request);

        return new TaskResource($task);
    }

    #[OA\Get(path: '/api/tasks/{id}', tags: ['Tasks'], summary: 'Get a task')]
    #[OA\Response(
        response: 200,
        description: 'Successful operation',
        content: new OA\JsonContent(ref: TaskResource::class)
    )]
    #[OA\Response(
        response: 404,
        description: 'Error: Not Found',
        content: new OA\JsonContent(ref: MessageResource::class)
    )]
    public function show(#[OA\PathParameter] int $id): TaskResource
    {
        $task = $this->taskService->findOneByIdOrFail($id);

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OA\Put(path: '/api/tasks/{id}', tags: ['Tasks'], summary: 'Update a task')]
    #[OA\RequestBody(
        required: true,
        description: 'New data for a task',
        content: new OA\JsonContent(ref: TaskRequest::class)
    )]
    #[OA\Response(
        response: 200,
        description: 'Successful operation',
        content: new OA\JsonContent(ref: TaskResource::class)
    )]
    #[OA\Response(
        response: 404,
        description: 'Error: Not Found',
        content: new OA\JsonContent(ref: MessageResource::class)
    )]
    #[OA\Response(
        response: 422,
        description: 'Error: Unprocessable Content'
    )]
    public function update(#[OA\PathParameter] int $id, TaskRequest $request): TaskResource
    {
        $task = $this->taskService->update($id, $request);

        return new TaskResource($task);
    }

    #[OA\Delete(path: '/api/tasks/{id}', tags: ['Tasks'], summary: 'Delete a task')]
    #[OA\Response(
        response: 200,
        description: 'Successful operation',
        content: new OA\JsonContent(ref: MessageResource::class)
    )]
    #[OA\Response(
        response: 404,
        description: 'Error: Not Found',
        content: new OA\JsonContent(ref: MessageResource::class)
    )]
    public function destroy(#[OA\PathParameter] int $id): MessageResource
    {
        $this->taskService->destroy($id);

        return new MessageResource(null)
            ->setMessage('The task was successfully deleted');
    }
}
