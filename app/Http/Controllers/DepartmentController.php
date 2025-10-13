<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view("department.index", compact("departments"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|unique:departments,name'
            ],
            [
                'name.unique' => 'This department already exists.'
            ]
        );

        Department::create($validated);

        return redirect()->back()->with('success', 'Department created successfully');
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $department->update($validated);

        return redirect()->back()->with('success', 'Department updated successfully');
    }

    public function destroy(Department $department)
    {
        try {
            $department->delete();

            return redirect()->back()->with('success', 'Department deleted successfully.');
        } catch (\Exception $e) {
            // Optional: catch errors if delete fails
            return redirect()->back()->with('error', 'Failed to delete the department.');
        }
    }
}
