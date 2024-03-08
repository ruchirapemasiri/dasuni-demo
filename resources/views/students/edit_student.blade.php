@extends('layouts.document')


@section('title', 'Student Registration Edit')


@section('styles')

    <style>
        html {
            overflow: hidden;
            width: 100%;
            height: 100%;
        }

        body {
            margin: 0;
            overflow: hidden;
            width: 100%;
            height: 100%;
        }

        .container>.row {
            margin-bottom: 2vh;
        }

        .align-center {
            display: flex;
            align-items: center;
        }

        .register-form-div {
            margin-top: 5vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .register-form {
            width: 53vw;
        }

        .data-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .input {
            background: #bdc3c7;
            border: none;
            outline: none;
            padding: 1vw;
            width: 100%;
            border-radius: 10px;
        }

        .add-student-btn {
            color: #fff;
            background: #8e44ad;
            padding: 2vw 6vw;
            margin-top: 8vh;
            border: none;
            border-radius: 15px;
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

        .error-message {
            color: red;
            font-size: 12px;
        }
    </style>

@endsection

@section('content')

    <div>
        <button class="back-btn" id="back-btn">
            < Back </button>
    </div>

    <div class="register-form-div">
        <form class="register-form" method="POST" action="{{ route('students.edit_student',$student->id) }}">
            @csrf
            @method('PUT')
            
            <div class="container">

                <div class="row">
                    <div class="col-5 align-center">
                        <label for="std-name">Student Full Name</label>
                    </div>
                    <div class="col-7">
                        <textarea class="input" name="student_fname" id="std-name" rows="2">{{ $student->full_name }}</textarea>
                        @error('student_fname')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-5 align-center">
                        <label for="birthday">Birthday:</label>
                    </div>
                    <div class="col-7">
                        <input class="input" type="date" id="birthday" name="birthday" value="{{ $student->date_of_birth }}">
                        @error('birthday')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-5 align-center">
                        <label for="address">Home Address</label>
                    </div>
                    <div class="col-7">
                        <textarea class="input" name="address" id="address" rows="2">{{ $student->address }}</textarea>
                        @error('address')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-5 align-center">
                        <label for="phone-number">Mobile Number</label>
                    </div>
                    <div class="col-7">
                        <input class="input" text="text" name="phone_number" id="phone-number"
                            value="{{ $student->phone_number }}" />

                        @error('phone_number')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-5 align-center">
                        <label for="license-type">License type</label>
                    </div>
                    <div class="col-7">
                        <input class="input" text="text" name="license_type" id="license-type"
                            value="{{ $student->license_type }}" />

                        @error('license_type')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-5 align-center">
                        <label for="branch">Branch</label>
                    </div>
                    <div class="col-7">
                        <input class="input" text="text" name="branch" id="branch" value="{{ $student->branch }}" />
                        @error('branch')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

            </div>

        </form>

        <div>
            <button class="add-student-btn" id="add-student-btn">
                Update
            </button>

            @if (session('success'))
                <div style="margin-top: 2vh">
                    {{ session('success') }}
                </div>
            @endif

        </div>


    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('back-btn').addEventListener('click', function() {
                window.location.href = "{{ route('students_list') }}";
            });

            var submitFormButton = document.getElementById('add-student-btn');

            submitFormButton.addEventListener('click', function() {
                var form = document.querySelector('.register-form');
                form.submit();
            });
        });
    </script>



@endsection
