@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Courses</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="{{ route('courses.create') }}"
                                class="btn btn-success mb-3 text-white">Create Course</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    @if (isset($errors) && count($errors))
        There were {{ count($errors->all()) }} Error(s)
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }} </li>
            @endforeach
        </ul>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">

        <table class="table table-bordered border-dark">
            <thead class="bg-dark text-white">
                <tr class="text-center">
                    <th>Course Image</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Course Desc</th>
                    <th>Course Start</th>
                    <th>Course Ended</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody><?php
            $total = 0;
            ?>
                @if (count($courses) > 0)
                    @foreach ($courses as $course)
                        <?php $total++; ?>
                        <tr class="text-center">
                            <td class="align-middle text-center" width="8%"> <img
                                    src="{{ asset('admin/assets/uploads/courses') }}/{{ $course->CourseImage }}"
                                    alt="{{ $course->CourseName }}" height="80"></td>
                            <td class="align-middle text-center">{{ $course->CourseCode }}</td>
                            <td class="align-middle text-center">{{ $course->CourseName }}</td>
                            <td class="align-middle text-center">{{ $course->CourseDescription }}</td>
                            <td class="align-middle text-center">{{ date('d F Y', strtotime($course->CourseStartDate)) }}
                            </td>
                            <td class="align-middle text-center">{{ date('d F Y', strtotime($course->CourseEndDate)) }}</td>

                            <td class="align-middle text-center" width="7%">
                                <a href="{{ route('courses.show', $course->CourseCode) }}"
                                    class="btn btn-outline-info btn-sm edit"> <i class="bx bxs-show"></i></a>
                                <a href="{{ route('courses.edit', $course->CourseCode) }}"
                                    class="btn btn-outline-warning btn-sm edit"> <i class="bx bxs-edit"></i></a>
                                <form action="{{ route('courses.destroy', $course->CourseCode) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm "
                                        onclick="return confirm('Are you sure you want to delete this course?')"> <i
                                            class="bx bxs-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center">
                            <p class="font-size-15">No courses found...!</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="float-end">
            <p>Total Records: <strong>{{ $total }}</strong></p>
        </div>
    </div>
@endsection
