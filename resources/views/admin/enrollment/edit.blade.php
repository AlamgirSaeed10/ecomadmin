<!-- resources/views/edit_enrollment.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Enrollment</h1>
        @if (isset($errors) && count($errors))
        There were {{ count($errors->all()) }} Error(s)
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }} </li>
            @endforeach
        </ul>
    @endif
        <form action="{{ route('enrollments.update', $enrollment->EnrollmentID) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="PlanID">Select Plan</label>
                        <select name="PlanID" class="form-control">
                            @php
                                $plans = DB::table('course_plan')->get();
                            @endphp
                            @foreach ($plans as $plan)
                                <option value="{{ $plan->PlanID }}" @if($plan->PlanID == $enrollment->PlanID) selected @endif>
                                    {{ $plan->PlanTitle }}
                                </option>
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
                            @foreach ($courses as $course)
                                <option value="{{ $course->CourseCode }}" @if($course->CourseCode == $enrollment->CourseCode) selected @endif>
                                    {{ $course->CourseName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        @php
                            $studentID = 'STU-' . date('dY') . strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 1));
                            $existingID = DB::table('enrollment')->where('StudentID', $studentID)->exists();
                            if ($existingID) {
                                $studentID = 'STU-' . date('dY') . strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 1));
                            }
                        @endphp
                        <input type="hidden" readonly name="StudentID" class="form-control" required value="{{ $studentID }}">
                        <label class="mt-2" for="StudentName">Student Name</label>
                        <input type="text" name="StudentName" class="form-control" required value="{{ $enrollment->StudentName }}">
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="FatherName">Father Name</label>
                        <input type="text" name="FatherName" class="form-control" required value="{{ $enrollment->FatherName }}">
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="StudentCNIC">Student CNIC</label>
                        <input type="text" name="StudentCNIC" class="form-control" required value="{{ $enrollment->StudentCNIC }}">
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="StudentPhone">Student Phone</label>
                        <input type="text" name="StudentPhone" class="form-control" required value="{{ $enrollment->StudentPhone }}">
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="StudentCity">Student City</label>
                        <input type="text" name="StudentCity" class="form-control" required value="{{ $enrollment->StudentCity }}">
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="StudentEmail">Student Email</label>
                        <input type="email" name="StudentEmail" class="form-control" required value="{{ $enrollment->StudentEmail }}">
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="StudentGender">Student Gender</label>
                        <select name="StudentGender" class="form-control" required>
                            <option value="Male" @if($enrollment->StudentGender == 'Male') selected @endif>Male</option>
                            <option value="Female" @if($enrollment->StudentGender == 'Female') selected @endif>Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="TrainingMode">Training Mode</label>
                        <select name="TrainingMode" class="form-control" required>
                            <option value="On Site" @if($enrollment->TrainingMode == 'On Site') selected @endif>On Site</option>
                            <option value="Online" @if($enrollment->TrainingMode == 'Online') selected @endif>Online</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="PaymentOption">Payment Option</label>
                        <select name="PaymentOption" class="form-control" required>
                            <option value="Cash" @if($enrollment->PaymentOption == 'Cash') selected @endif>Cash</option>
                            <option value="Bank Transfer" @if($enrollment->PaymentOption == 'Bank Transfer') selected @endif>Bank Transfer</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="KnowAboutUs">Know About Us</label>
                        <select name="KnowAboutUs" class="form-control" required>
                            <option value="Referral" @if($enrollment->KnowAboutUs == 'Referral') selected @endif>Referral</option>
                            <option value="Social Media" @if($enrollment->KnowAboutUs == 'Social Media') selected @endif>Social Media</option>
                            <option value="Another Website" @if($enrollment->KnowAboutUs == 'Another Website') selected @endif>Another Website</option>
                            <option value="Ad" @if($enrollment->KnowAboutUs == 'Ad') selected @endif>Ad</option>
                            <option value="Search Engine" @if($enrollment->KnowAboutUs == 'Search Engine') selected @endif>Search Engine</option>
                            <option value="Other" @if($enrollment->KnowAboutUs == 'Other') selected @endif>Other</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="mt-2" for="KnowAboutUs">Enrollment Status</label>
                        <select name="EnrollmentStatus" class="form-control" required>
                            <option value="Pending">Pending</option>
                            <option value="Accepted">Accepted</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
@endsection
