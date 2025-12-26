<?php

namespace App\Services;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

final readonly class TaskService
{
    public function findAll(): Collection
    {
        return Task::all();
    }

    public function create(TaskRequest $request): Task
    {
        $task = new Task();
        $task->fill($request->validated());
        $task->save();

        return $task;
    }
}
