<?php

namespace App\Services;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface TaskServiceInterface
{
    public function findAll(Request $request): LengthAwarePaginator;

    public function findOneByIdOrFail(int $id): Task;

    public function create(TaskRequest $request): Task;

    public function update(int $id, TaskRequest $request): Task;

    public function destroy(int $id): void;
}
