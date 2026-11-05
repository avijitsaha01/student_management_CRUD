<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
    public function index(Request $request)
    {
        // Support optional search by student_id, name, email, or department
        $search = $request->query('search');

        $studentsQuery = Student::query();

        if ($search) {
            $studentsQuery->where(function ($query) use ($search) {
                $query->where('student_id', 'like', "%{$search}%")
                      ->orWhere('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('department', 'like', "%{$search}%");
            });
        }

        // Fetch students ordered by latest first
        $students = $studentsQuery->latest()->get();

        // Dashboard statistics
        $totalStudents = Student::count();
        $totalDepartments = Student::distinct('department')->count('department');
        $totalSemesters = Student::distinct('semester')->count('semester');

        return view('students.index', compact('students', 'totalStudents', 'totalDepartments', 'totalSemesters', 'search'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        // Validate student registration input
        $validated = $request->validate([
            'student_id' => ['required', 'string', 'max:20', 'unique:students,student_id'],
            'name'       => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email', 'max:100', 'unique:students,email'],
            'phone'      => ['required', 'string', 'max:20'],
            'department' => ['required', 'string', 'max:100'],
            'semester'   => ['required', 'string', 'max:20'],
        ], [
            'student_id.required' => 'The Student ID field is required.',
            'student_id.unique'   => 'This Student ID has already been registered.',
            'email.required'      => 'The Email field is required.',
            'email.email'         => 'Please provide a valid email address.',
            'email.unique'        => 'This Email address has already been registered.',
            'name.required'       => 'The Student Name field is required.',
            'phone.required'      => 'The Phone Number field is required.',
            'department.required' => 'Please select or enter a Department.',
            'semester.required'   => 'Please select or enter a Semester.',
        ]);

        // Save student to MySQL database
        Student::create($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student record has been created successfully!');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        // Validate updated information; ignore the current student's ID for uniqueness
        $validated = $request->validate([
            'student_id' => [
                'required',
                'string',
                'max:20',
                Rule::unique('students', 'student_id')->ignore($student->id),
            ],
            'name'       => ['required', 'string', 'max:100'],
            'email'      => [
                'required',
                'email',
                'max:100',
                Rule::unique('students', 'email')->ignore($student->id),
            ],
            'phone'      => ['required', 'string', 'max:20'],
            'department' => ['required', 'string', 'max:100'],
            'semester'   => ['required', 'string', 'max:20'],
        ], [
            'student_id.required' => 'The Student ID field is required.',
            'student_id.unique'   => 'This Student ID belongs to another student.',
            'email.required'      => 'The Email field is required.',
            'email.email'         => 'Please provide a valid email address.',
            'email.unique'        => 'This Email address belongs to another student.',
            'name.required'       => 'The Student Name field is required.',
            'phone.required'      => 'The Phone Number field is required.',
            'department.required' => 'Please select or enter a Department.',
            'semester.required'   => 'Please select or enter a Semester.',
        ]);

        // Save updated data
        $student->update($validated);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student information updated successfully!');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        $studentName = $student->name;
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', "Student '{$studentName}' has been deleted successfully!");
    }
}
