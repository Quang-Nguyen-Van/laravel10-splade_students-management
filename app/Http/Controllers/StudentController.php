<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Student;
use App\Tables\Students;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $this->authorize('student_access');

        return view('students.index', [
            'students' => Students::class,
        ]);
    }

    public function create()
    {
        $this->authorize('student_create');

        $sections = Section::with('class')->get();
        return view('students.create', compact('sections'));
    }

    public function store(StoreStudentRequest $request)
    {
        $this->authorize('student_create');

        $section = Section::findOrFail($request->section_id);

        $avatar = $request->file('avatar');

        $avatarName = $avatar->hashName();

        Storage::put('public/avatars', $avatar);

        $student = Student::create(
            // array_merge(
            //     $request->validated(),
            [
                'class_id' => $section->class_id,
                'avatar' => "storage/avatars/$avatarName",
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'section_id' => $request->section_id,
            ]
            // )
        );

        Splade::toast('Student created')->autoDismiss(4);

        return back();
    }

    public function edit(Student $student)
    {
        $this->authorize('student_edit');

        $sections = Section::with('class')->get();
        return view('students.edit', compact('student', 'sections'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $this->authorize('student_edit');

        $section = Section::findOrFail($request->section_id);

        $avatar = $request->file('avatar');

        $avatarName = $avatar->hashName();

        Storage::put('public/avatars', $avatar);

        $student->update(
            // array_merge($request->validated(), ['class_id' => $section->class_id])
            [
                'class_id' => $section->class_id,
                'avatar' => "storage/avatars/$avatarName",
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'section_id' => $request->section_id,
            ]
        );

        Splade::toast('Student updated')->autoDismiss(4);

        return back();
    }

    public function destroy(Student $student)
    {
        $this->authorize('student_delete');

        $student->delete();

        Splade::toast('Student deleted')->autoDismiss(4);

        return to_route('students.index');
    }
}
