@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Course</h1>

        <form action="{{ route('courses.update', $course->CourseCode) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                        <input type="text" name="CourseCode" id="courseCode" class="form-control"
                            value="{{ $course->CourseCode }}" hidden>

                <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label for="courseName">Course Name:</label>
                        <input type="text" name="CourseName" id="courseName" class="form-control"
                            value="{{ $course->CourseName }}" required>
                    </div>
                </div>

                <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label for="courseStartDate">Course Start Date:</label>
                        <input type="date" name="CourseStartDate" id="courseStartDate" class="form-control"
                        value="{{ $course->CourseStartDate }}" required>
                    </div>
                </div>
                <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label for="courseEndDate">Course End Date:</label>
                        <input type="date" name="CourseEndDate" id="courseEndDate" class="form-control"
                        value="{{ $course->CourseEndDate }}" required>
                    </div>
                </div>
                <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label for="CourseImage">Course Image:</label>
                        <input type="file" name="CourseImage" id="courseImage" class="form-control" value="{{ $course->CourseImage }}">

                        @error('CourseImage')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="mb-3 col-lg-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="form-group">
                        <label for="courseDescription">Course Description:</label>
                        <textarea name="CourseDescription" id="courseDescription" class="form-control"  required>{{ $course->CourseDescription }}</textarea>
                    </div>
                </div>
                <div class="mb-3 col-lg-4 col-sm-12 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label for="CourseImage">Course Image:</label>
                        <img src="{{asset('admin/assets/uploads/courses')}}/{{ $course->CourseImage }}" height="250">
                    </div>
                </div>
            </div>
                <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
