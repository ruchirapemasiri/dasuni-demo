<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\StudentProfiles;

class StudentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('CheckRolePermissions:students,view')->only('viewStudentsList');
        $this->middleware('CheckRolePermissions:students,create')->only('insertStudent');
        $this->middleware('CheckRolePermissions:students,update')->only('updateStudentForm');
        $this->middleware('CheckRolePermissions:students,delete')->only('deleteStudent');
    }

    public function viewStudentsList(){

        $allUserPermissions = json_decode(auth()->user()->access, true);

        $permissions = $allUserPermissions['students'];

        $students = StudentProfiles::all();

        return view('students.student_list', compact('students','permissions'));

    }


    public function insertStudent(Request $request){

        $validatedData = $request->validate([
            'student_fname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'license_type' => 'required|string',
            'branch' => 'required|string',
        ]);

        $student = new StudentProfiles();

        $student->full_name = $validatedData['student_fname'];
        $student->date_of_birth = $validatedData['birthday'];
        $student->address = $validatedData['address'];
        $student->phone_number = $validatedData['phone_number'];
        $student->license_type = $validatedData['license_type'];
        $student->branch = $validatedData['branch'];

        $student->save();

        return redirect()->back()->with('success', 'Student added successfully!');

    }

    public function updateStudentForm(Request $request, $id){

        $student = StudentProfiles::findOrFail($id);
        return view('students.edit_student', compact('student'));
    }

    public function updateStudent(Request $request, $id){

        $validatedData = $request->validate([
            'student_fname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'license_type' => 'required|string',
            'branch' => 'required|string',
        ]);

        $data = [
            'full_name' => $validatedData['student_fname'],
            'date_of_birth' => $validatedData['birthday'],
            'address' => $validatedData['address'],
            'phone_number' => $validatedData['phone_number'],
            'license_type' => $validatedData['license_type'],
            'branch' => $validatedData['branch'],
        ];

        // dd($data);

        $student = StudentProfiles::findOrFail($id);

        $student->update($data);

        return redirect()->route('students.edit_student_form',$id)->with('success', 'Student updated successfully');

    }


    public function deleteStudent($id){

        $student = StudentProfiles::findOrFail($id);

        $student->delete();

        return redirect()->route('students_list')->with('success', 'Student Deleted successfully');

    }

}
