<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Serves both Dashboard and Student Repository with clean metrics
    public function index()
    {
        $students = Student::all();
        $totalStudents = $students->count();
        $activeCount = $students->where('status', 'Active')->count();
        $inactiveCount = $students->where('status', 'Inactive')->count();

        // Dynamically serve the view based on the URL pathway requested
        if (request()->is('students')) {
            return view('students', compact('students', 'totalStudents', 'activeCount', 'inactiveCount'));
        }

        return view('dashboard', compact('students', 'totalStudents', 'activeCount', 'inactiveCount'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'student_id' => 'required|string|unique:students,student_id',
            'course'     => 'required|string|max:255',
            'year'       => 'required|string',
            'status'     => 'required|string',
        ]);

        Student::create($validated);
        return redirect()->back()->with('success', 'Student record added successfully!');
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'student_id' => 'required|string|unique:students,student_id,' . $id,
            'course'     => 'required|string|max:255',
            'year'       => 'required|string',
            'status'     => 'required|string',
        ]);

        $student->update($validated);
        return redirect()->back()->with('success', 'Student record updated successfully!');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->back()->with('success', 'Student record deleted successfully!');
    }
}