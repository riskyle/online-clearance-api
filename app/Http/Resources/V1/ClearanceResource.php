<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClearanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'studentId' => $this->student_id,
            'schoolPersonnelId' => $this->school_personnel_id,
            'schoolPersonnel' => $this->schoolPersonnel->sp_firstname,
            'quarterId' => $this->quarter_id,
            'quarter' => $this->quarter->quarter_name,
            'description' => $this->description,
            'task'  => $this->task,
            'dueDateAt'  => $this->due_date,
            'postedDateAt' => $this->created_at,
            'student' => $this->student,
        ];
    }
}
