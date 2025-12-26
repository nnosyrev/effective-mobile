<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

final readonly class TaskService
{
    public function findAll(): Collection
    {
        return Task::all();
    }
}
