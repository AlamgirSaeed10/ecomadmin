@extends('layouts.app')
@section('content')
    <h1>Course Details</h1>
    <div class="table-responsive">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
                <table class="table table-bordered border-dark">
                    <tr>
                        <th>Course Code</th>
                        <td>{{ $course->CourseCode }}</td>
                    </tr>
                    <tr>
                        <th>Course Image</th>
                        <td>{{ $course->CourseImage }}</td>
                    </tr>
                    <tr>
                        <th>Course Name</th>
                        <td>{{ $course->CourseName }}</td>
                    </tr>
                    <tr>
                        <th>Course Description</th>
                        <td>{{ $course->CourseDescription }}</td>
                    </tr>
                    <tr>
                        <th>Course Start Date</th>
                        <td>{{ $course->CourseStartDate }}</td>
                    </tr>
                    <tr>
                        <th>Course End Date</th>
                        <td>{{ $course->CourseEndDate }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <img src="{{asset('admin/assets/uploads/courses') }}/{{ $course->CourseImage }}"
                    alt="" height="250">
            </div>
        </div>
    </div>
    <a href="{{ route('courses.index') }}" class="btn btn-primary">Back</a>
@endsection
