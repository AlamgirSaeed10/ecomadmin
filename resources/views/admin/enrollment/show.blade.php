@extends('layouts.app')

@section('content')
    <h1>Enrollment Details</h1>
    <div class="table-responsive">
    <table class="table table-bordered border-dark">
        <tr>
            <th>Plan Title</th>
            <td>
                @php
                    $plan = DB::table('course_plan')
                        ->where('PlanID', $enrollment->PlanID)
                        ->get();
                @endphp
                {{ $plan[0]->PlanTitle }}
            </td>
        </tr>
        <tr>
            <th>Course Name</th>
            <td> @php
                $course = DB::table('courses_offered')
                    ->where('CourseCode', $enrollment->CourseCode)
                    ->get();
            @endphp
                {{ $course[0]->CourseName }}</td>
        </tr>
        <tr>
            <th>Student ID</th>
            <td>{{ $enrollment->StudentID }}</td>
        </tr>
        <tr>
            <th>Student Name</th>
            <td>{{ $enrollment->StudentName }}</td>
        </tr>
        <tr>
            <th>Father Name</th>
            <td>{{ $enrollment->FatherName }}</td>
        </tr>
        <tr>
            <th>Student CNIC</th>
            <td>{{ $enrollment->StudentCNIC }}</td>
        </tr>
        <tr>
            <th>Student Phone</th>
            <td>{{ $enrollment->StudentPhone }}</td>
        </tr>
        <tr>
            <th>Student City</th>
            <td>{{ $enrollment->StudentCity }}</td>
        </tr>
        <tr>
            <th>Student Email</th>
            <td>{{ $enrollment->StudentEmail }}</td>
        </tr>
        <tr>
            <th>Student Education</th>
            <td>{{ $enrollment->StudentEducation }}</td>
        </tr>
        <tr>
            <th>Training Mode</th>
            <td>{{ $enrollment->TrainingMode }}</td>
        </tr>
        <tr>
            <th>Payment Option</th>
            <td>{{ $enrollment->PaymentOption }}</td>
        </tr>
        <tr>
            <th>Know About Us</th>
            <td>{{ $enrollment->KnowAboutUs }}</td>
        </tr>
        <tr>
            <th>Enrollment Status</th>
            <td>{{ $enrollment->EnrollmentStatus }}</td>
        </tr>
    </table>
    </div>

    <a href="{{ route('enrollments.index') }}" class="btn btn-info">Back</a>
@endsection
