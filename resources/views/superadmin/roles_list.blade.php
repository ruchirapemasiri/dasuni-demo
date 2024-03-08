@extends('layouts.document')

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

        .roles-container {
            display: flex;
            flex-direction: column;
        }

        .role {
            display: flex;
            gap: 5vw;
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

        table,
        th,
        td {
            border: 1px solid black;
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
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="head-title">List of Roles</div>

        <div class="row d-flex justify-content-end">
            <a class="add-student-btn" href="{{ route('create_role_form') }}" disabled>
                Add New Role
            </a>
        </div>

        <div class="roles-container">

            <div class="table-container">
                <table class="students-table" style="width:70%">
                    <tr>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th></th>
                        <th></th>
                    </tr>

                    @foreach ($roles as $index => $role)
                        <tr>
                            <td>
                                <span>{{ $role->role }}</span>
                            </td>

                            @php
                                $accesses = json_decode($role->access, true);
                            @endphp

                            <td>
                                @foreach ($accesses as $key => $access)
                                    <span>{{ $key }}</span> ---

                                    @foreach ($accesses[$key] as $permission)
                                        <span>{{ $permission }}</span> /
                                    @endforeach
                                @endforeach
                            </td>

                            <td>
                                <button class="edit-btn"
                                onclick="window.location.href = '{{ route('superadmin.edit_role', $role->id) }}'">
                                    Edit
                                </button>
                            </td>
                            <td>
                                <form action="{{ route('superadmin.delete_role', $role->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="delete-btn" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>

        </div>
    </div>
@endsection
