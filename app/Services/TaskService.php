<?php

namespace App\Services;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

final readonly class TaskService implements TaskServiceInterface
{
    private const int DEFAULT_PER_PAGE = 10;

    public function findAll(Request $request): LengthAwarePaginator
    {
        $perPage = (int) $request->query('per_page', self::DEFAULT_PER_PAGE);

        return Task::paginate($perPage);
    }

    public function findOneByIdOrFail(int $id): Task
    {
        return Task::where('id', '=', $id)
            ->firstOrFail();
    }

    public function create(TaskRequest $request): Task
    {
        $task = new Task();
        $task->fill($request->validated());
        $task->save();

        return $task;
    }

    public function update(int $id, TaskRequest $request): Task
    {
        $task = $this->findOneByIdOrFail($id);

        $task = $this->doUpdate($task, $request);

        return $task;
    }

    public function destroy(int $id): void
    {
        $task = $this->findOneByIdOrFail($id);

        $this->doDestroy($task);
    }

    private function doUpdate(Task $task, TaskRequest $request): Task
    {
        $task->fill($request->validated());
        $task->save();

        return $task;
    }

    private function doDestroy(Task $task): void
    {
        $task->delete();
    }
}
