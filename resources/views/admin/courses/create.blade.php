@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Course</h1>
        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
                    <div class="form-group">
                        <label class="mt-3" for="courseCode">Course Code:</label>
                        @php
                        $CourseCode = 'OCC-' . rand(999, 9999) . strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 1));
                        $existingID = DB::table('enrollment')
                            ->where('StudentID', $CourseCode)
                            ->exists();
                        if ($existingID) {
                            $CourseCode = 'OCC-' . rand(1000, 9999). strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 1));
                        }
                    @endphp
                        <input type="text" readonly name="CourseCode" id="courseCode" value="{{$CourseCode}}" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
                    <div class="form-group">
                        <label class="mt-3" for="courseName">Course Name:</label>
                        <input type="text" name="CourseName" id="courseName" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
                    <div class="form-group">
                        <label class="mt-3" for="courseImage">Course Image:</label>
                        <input type="file" name="CourseImage" id="CourseImage" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
                    <div class="form-group">
                        <label class="mt-3" for="courseStartDate">Course Start Date:</label>
                        <input type="date" name="CourseStartDate" id="courseStartDate" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
                    <div class="form-group">
                        <label class="mt-3" for="courseEndDate">Course End Date:</label>
                        <input type="date" name="CourseEndDate" id="courseEndDate" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
                    <div class="form-group">
                        <label class="mt-3" for="courseDescription">Course Description:</label>
                        <textarea name="CourseDescription" id="courseDescription" class="form-control" required></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
