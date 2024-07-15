<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ClearanceCollection;
use App\Models\Clearance;
use App\Models\Student;
use App\Models\SchoolPersonnel;
use App\Http\Requests\StoreClearanceRequest;
use App\Http\Resources\V1\ClearanceResource;
use Illuminate\Support\Facades\Gate;

class ClearanceController extends Controller
{

    public function index(Clearance $clearance)
    {
        return new ClearanceCollection($clearance->getClearances());
    }

    public function show(Clearance $clearance)
    {
        return new ClearanceResource($clearance);
    }

    public function store(Student $student, StoreClearanceRequest $request, SchoolPersonnel $sp)
    {
        $sp = $sp->findSp(auth()->user()->id);

        Clearance::create([
            'student_id' => $student->lrn,
            'school_personnel_id' => $sp->id,
            'quarter_id' => $request->quarterId,
            'description' => $request->description,
            'task' => $request->task,
            'due_date' => $request->dueDate,
        ]);

        return response()->json(['message' => "Successfully added clearance to $student->student_lastname!"]);
    }

    public function bulkStoreClearance(StoreClearanceRequest $request, Student $student, SchoolPersonnel $sp)
    {
        $students = $student->getStudent(ucwords($request->studentSection));

        if ($students->count() === 0) {

            return response()->json(['message' => 'There is no student in this section!']);
        }

        $sp = $sp->findSp(auth()->user()->id);

        $clearances = [];

        foreach ($students as $student) {

            $clearances[] = [
                'student_id' => $student->lrn,
                'school_personnel_id' => $sp->id,
                'quarter_id' => $request->quarterId,
                'description' => $request->description,
                'task' => $request->task,
                'due_date' => $request->dueDate,
            ];
        }

        Clearance::insert($clearances);

        return response()->json(['message' => 'Successfully added clearance!']);
    }

    public function destroy(Clearance $clearance)
    {
        Gate::authorize('delete', $clearance);

        $clearance->delete();

        return response()->json(['message' => 'Successfully deleted clearance!']);
    }

    public function update()
    {
        // I'am gonna think about this method
    }

    public function updateSelectedClearance()
    {
        // I'am gonna think about this method
    }
}
