@extends('layouts.document')


@section('title', 'Student List')


@section('styles')

    <style>
        html {
            overflow: hidden;
            width: 100%;
            height: 100%;
        }

        body {
            background: #121212;
            margin: 0;
            overflow: hidden;
            width: 100%;
            height: 100%;
        }

        .head-title {
            color: #efd3d7;
            font-size: 37px;
            font-weight: 700;
        }

        .table-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .students-table {}

        table,
        th,
        td {
            border: 1px solid black;
        }



        .table-container {
            overflow-x: auto;
            /* Enable horizontal scrolling if needed */
        }

        .students-table {
            width: 100%;
            border-collapse: collapse;
        }

        .students-table th,
        .students-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
            /* Add bottom border to each row */
        }

        .students-table th {
            background-color: #212121;
            /* Dark theme background color for table header */
            color: #ffffff;
            /* White text color for table header */
        }

        .students-table tr {
            background-color: #f2f2f2;
            /* Alternate row color */
        }

        .students-table tr:hover {
            background-color: #dddddd;
            /* Hover effect color */
        }

        .students-table td {
            border-bottom: 1px solid #dddddd;
            /* Add bottom border to each cell */
        }

        .students-table p {
            margin: 0;
            /* Remove default margin for paragraphs */
        }

        .add-student-btn {
            text-decoration: none;
            border: none;
            color: #FFFFFF;
            background-color: #8338ec;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 18vw;
            height: 5vh;
        }

        .disabled-link {
            opacity: 0.6;
            pointer-events: none;
            background-color: gray !important;
            text-decoration: none;
        }

        .disabled {
            opacity: 0.5;
            pointer-events: none;
            background-color: gray !important;
            text-decoration: none;
        }

        .edit-btn {
            border: none;
            border-radius: 10px;
            background-color: #50C4ED;
        }

        .delete-btn {
            border: none;
            border-radius: 10px;
            background-color: #EE4266;
        }
    </style>

@endsection

@section('content')

    <div class="container">

        <div class="head-title">
            Students Management
        </div>

        <div class="row d-flex justify-content-end">
            @if (in_array('create', $permissions))
                <a class="add-student-btn" href="{{ route('students.create_student') }}">
                    Add New Student
                </a>
            @else
                <a class="add-student-btn disabled-link" href="{{ route('students.create_student') }}" disabled>
                    Add New Student
                </a>
            @endif
        </div>

        <div class="table-container">
            <table class="students-table" style="width:70%">
                <tr>
                    <th>Student Name</th>
                    <th>License type</th>
                    <th>Branch</th>
                    <th>Actions</th>
                </tr>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->full_name }}</td>
                        <td>{{ $student->license_type }}</td>
                        <td>{{ $student->branch }}</td>
                        <td>
                            <div class="d-flex" style="gap: 2vw">
                                @if (in_array('update', $permissions))
                                    <button class="edit-btn"
                                        onclick="window.location.href = '{{ route('students.edit_student_form', $student->id) }}'">
                                        Edit
                                    </button>
                                @else
                                    <button class="edit-btn disabled"
                                        onclick="window.location.href = '{{ route('students.edit_student_form', $student->id) }}'"
                                        disabled>
                                        Edit
                                    </button>
                                @endif
                                <form action="{{ route('students.delete_student', $student->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @if (in_array('delete', $permissions))
                                        <button class="delete-btn" type="submit">Delete</button>
                                    @else
                                        <button class="delete-btn disabled" type="submit" disabled>Delete</button>
                                    @endif
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No users</td>
                    </tr>
                @endforelse
            </table>
        </div>

    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {


        });
    </script>



@endsection
