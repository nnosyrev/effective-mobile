<?php

namespace App\Http\Requests;

use App\Models\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Attributes as OA;

#[OA\Schema(
    required: ['title', 'description', 'status', 'executor_id'],
    properties: [
        new OA\Property(property: 'title', example: 'Title'),
        new OA\Property(property: 'description', example: 'Description'),
        new OA\Property(property: 'status', format: 'string', example: 'planned'),
    ]
)]
final class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:128',
            'description' => 'required|max:255',
            'status' => [
                'required',
                Rule::in(TaskStatus::values()),
            ],
        ];
    }
}
