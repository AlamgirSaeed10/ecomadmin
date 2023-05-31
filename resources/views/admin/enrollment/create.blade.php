@extends('layouts.app')
@section('content')

    <div class="container">
        <h1>Enrollment Form</h1>

        @if (isset($errors) && count($errors))
            There were {{ count($errors->all()) }} Error(s)
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }} </li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="PlanID">Select Plan</label>
                        <select name="PlanID" class="form-control">

                            @php
                                $courses = DB::table('course_plan')->get();
                            @endphp
                            @foreach ($courses as $value)
                                <option value="{{ $value->PlanID }}">{{ $value->PlanTitle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="CourseCode">Course Name</label>
                        <select name="CourseCode" class="form-control">

                            @php
                                $courses = DB::table('courses_offered')->get();
                            @endphp
                            @foreach ($courses as $value)
                                <option value="{{ $value->CourseCode }}">{{ $value->CourseName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        @php
                            $stuentID = 'STU-' . date('dY') . strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 1));
                            $existingID = DB::table('enrollment')
                                ->where('StudentID', $stuentID)
                                ->exists();
                            if ($existingID) {
                                $stuentID = 'STU-' . date('dY') . strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 1));
                            }
                        @endphp
                        <input type="hidden" readonly name="StudentID" class="form-control" required
                            value="{{ $stuentID }}">
                        <label class="mt-2" for="StudentName">Student Name</label>
                        <input type="text" name="StudentName" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="FatherName">Father Name</label>
                        <input type="text" name="FatherName" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="StudentCNIC">Student CNIC</label>
                        <input type="text" name="StudentCNIC" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="StudentPhone">Student Phone</label>
                        <input type="text" name="StudentPhone" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="StudentCity">Student City</label>
                        <input type="text" name="StudentCity" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="StudentEmail">Student Email</label>
                        <input type="email" name="StudentEmail" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="StudentGender">Student Gender</label>
                        <select name="StudentGender" class="form-control" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="TrainingMode">Training Mode</label>
                        <select name="TrainingMode" class="form-control" required>
                            <option value="On Site">On Site</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="PaymentOption">Payment Option</label>
                        <select name="PaymentOption" class="form-control" required>
                            <option value="Cash">Cash</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">

                    <div class="form-group">
                        <label class="mt-2" for="KnowAboutUs">Know About Us</label>
                        <select name="KnowAboutUs" class="form-control" required>
                            <option value="Referral">Referral</option>
                            <option value="Social Media">Social Media</option>
                            <option value="Another Website">Another Website</option>
                            <option value="Ad">Ad</option>
                            <option value="Search Engine">Search Engine</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
@endsection
