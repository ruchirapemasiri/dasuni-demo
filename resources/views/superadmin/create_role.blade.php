@extends('layouts.document')

@if (isset($role))
    @section('title', 'Update Role')
@else
    @section('title', 'Add Role')
@endif



@section('styles')

    <style>
        html {
            overflow: hidden;
            width: 100%;
            height: 100%;
        }

        body {
            background: #FFF;
            margin: 0;
            overflow: hidden;
            width: 100%;
            height: 100%;
        }

        .head-title {
            color: black;
            font-size: 37px;
            font-weight: 700;
        }

        .back-btn {
            margin-left: 2vw;
            color: #fff;
            background: #8e44ad;
            padding: 2vw 1vw;
            margin-top: 4vh;
            border: none;
            border-radius: 15px;
        }

        .add-student-btn {
            color: #fff;
            background: #8e44ad;
            padding: 2vw 6vw;
            margin-top: 8vh;
            border: none;
            border-radius: 15px;
        }
    </style>

@endsection

@section('content')

<div>
    <button class="back-btn" id="back-btn" onclick="window.location.href='{{ route('roles_list') }}'">
        < Back </button>
</div>

    <div class="container">

        @if (isset($role))
            <div class="head-title">
                Update Role
            </div>
        @else
            <div class="head-title">
                Create Role
            </div>
        @endif


        <div>
            @if (isset($role))
                <form class="register-form" method="POST" action="{{ route('superadmin.update_role',$role->id) }}">
                    @csrf
                    @method('PUT')
                @else
                    <form class="register-form" method="POST" action="{{ route('superadmin.save_role') }}">
                        @csrf
            @endif

            <div class="container">

                <div class="row">
                    <div class="col-5 align-center">
                        <label for="role">Role</label>
                    </div>
                    <div class="col-7">
                        <input class="input" text="text" name="role" id="role"
                            value="{{ isset($role['role']) ? $role['role'] : old('role') }}" />

                        @error('role')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-5 align-center">
                        <label for="email">Email</label>
                    </div>
                    <div class="col-7">
                        <input class="input" text="text" name="email" id="email"
                            value="{{ isset($role['email']) ? $role['email'] : old('email') }}" />

                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                @if (!isset($role))
                    <div class="row">
                        <div class="col-5 align-center">
                            <label for="password">Password</label>
                        </div>
                        <div class="col-7">
                            <input class="input" text="text" name="password" id="password"
                                value="{{ old('password') }}" />
                            @error('password')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @endif

                @php
                    if (isset($role)) {
                        $access = json_decode($role->access, true);
                    }
                @endphp

                <div class="row">
                    <div class="col-5 align-center">
                        <label for="controllers">Controllers</label>
                    </div>
                    <div class="col-7">
                        <div>
                            <section>
                                <h3>Students</h3>

                                <input type="checkbox" id="std-view" name="students" value="view"
                                    onchange="dataFill(this)" {{ isset($access['students']) && in_array('view', $access['students']) ? 'checked' : '' }}>
                                <label for="std-view"> View Students</label><br>

                                <input type="checkbox" id="std-create" name="students" value="create"
                                    onchange="dataFill(this)"
                                    {{ isset($access['students']) && in_array('create', $access['students']) ? 'checked' : '' }}>
                                <label for="std-create"> Register Student</label><br>

                                <input type="checkbox" id="std-update" name="students" value="update"
                                    onchange="dataFill(this)"
                                    {{ isset($access['students']) && in_array('update', $access['students']) ? 'checked' : '' }}>
                                <label for="std-update"> Edit Student</label><br>

                                <input type="checkbox" id="std-delete" name="students" value="delete"
                                    onchange="dataFill(this)"
                                    {{ isset($access['students']) && in_array('delete', $access['students']) ? 'checked' : '' }}>
                                <label for="std-delete"> Delete Student</label><br>
                            </section>
                        </div>
                        <div>
                            <section>
                                <h3>Super Admin</h3>

                                <input type="checkbox" id="super-admin" name="super_admin" value="1"
                                    {{ isset($role) && $role->isSuperAdmin == true ? 'checked' : '' }}>
                                <label for="super-admin"> Create/Update/Delete User roles</label><br>
                            </section>
                        </div>
                    </div>
                </div>

            </div>

            </form>

            @if (isset($role))
                <button class="add-student-btn" id="add-role-btn">
                    Update Role
                </button>
            @else
                <button class="add-student-btn" id="add-role-btn">
                    Add Role
                </button>
            @endif
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                var submitFormButton = document.getElementById('add-role-btn');

                submitFormButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    var form = document.querySelector('.register-form');

                    var accessInput = document.createElement('input');
                    accessInput.type = 'hidden';
                    accessInput.name = 'access';
                    accessInput.value = JSON.stringify(ACCESS_DATA);
                    form.appendChild(accessInput);

                    form.submit();
                });

            });

            @if (isset($role))
                var ACCESS_DATA = {!! json_encode($access) !!};
            @else
                var ACCESS_DATA = {};
            @endif

            function dataFill(elem) {
                if (elem.type == 'checkbox') {
                    if (!ACCESS_DATA[elem.name]) {
                        ACCESS_DATA[elem.name] = []; // Initialize the array if it doesn't exist
                    }
                    if (elem.checked) {
                        ACCESS_DATA[elem.name].push(elem.value);
                    } else {
                        const index = ACCESS_DATA[elem.name].indexOf(elem.value);
                        if (index !== -1) {
                            ACCESS_DATA[elem.name].splice(index, 1); // Remove the action if unchecked
                        }
                    }
                }

                console.log(ACCESS_DATA);
            }
        </script>



    @endsection
