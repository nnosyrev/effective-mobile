<?php

namespace App\Services;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskServiceInterface
{
    public function findAll(): Collection;

    public function findOneByIdOrFail(int $id): Task;

    public function create(TaskRequest $request): Task;

    public function update(int $id, TaskRequest $request): Task;

    public function destroy(int $id): void;
}
