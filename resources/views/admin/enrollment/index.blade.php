@extends('layouts.app')
@section('content')



    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Enrollment</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="{{ route('enrollments.create') }}"
                                class="btn btn-success mb-3 text-white">Create Enrollment</a></li>
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
                    <th>Plan Title</th>
                    <th>Course Name</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Father Name</th>
                    <th>CNIC</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Mode</th>
                    <th>Option</th>
                    <th>Survey</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                    ?>
                @if (count($enrollments) > 0)
                    @foreach ($enrollments as $enrollment)
                    <tr>
                        <td class="align-middle text-center">
                            @php
                                    $total++;
                                    $plan = DB::table('course_plan')
                                        ->where('PlanID', $enrollment->PlanID)
                                        ->get();
                                @endphp
                                {{ $plan[0]->PlanTitle }}
                            </td>
                            <td class="align-middle text-center"> @php
                                $course = DB::table('courses_offered')
                                    ->where('CourseCode', $enrollment->CourseCode)
                                    ->get();
                            @endphp
                                {{ $course[0]->CourseName }}</td>
                            <td class="align-middle text-center">{{ $enrollment->StudentID }}</td>
                            <td class="align-middle text-center">{{ $enrollment->StudentName }}</td>
                            <td class="align-middle text-center">{{ $enrollment->FatherName }}</td>
                            <td class="align-middle text-center">{{ $enrollment->StudentCNIC }}</td>
                            <td class="align-middle text-center">{{ $enrollment->StudentPhone }}</td>
                            <td class="align-middle text-center">{{ $enrollment->StudentCity }}</td>
                            <td class="align-middle text-center">{{ $enrollment->StudentEmail }}</td>
                            <td class="align-middle text-center">{{ $enrollment->StudentGender }}</td>
                            <td class="align-middle text-center">{{ $enrollment->TrainingMode }}</td>
                            <td class="align-middle text-center">{{ $enrollment->PaymentOption }}</td>
                            <td class="align-middle text-center">{{ $enrollment->KnowAboutUs }}</td>
                            <td class="align-middle text-center">
                                <span
                                    class="badge bg-{{ $enrollment->EnrollmentStatus === 'Pending' ? 'warning' : ($enrollment->EnrollmentStatus === 'Accepted' ? 'success' : 'danger' )}} p-2 font-size-12">
                                    {{ $enrollment->EnrollmentStatus }}</span>
                            </td>
                            <td>
                                <a
                                    href="{{ route('enrollments.show', $enrollment->EnrollmentID) }}"class="btn btn-outline-info btn-sm edit"><i
                                        class="bx bxs-show"></i></a>
                                <a
                                    href="{{ route('enrollments.edit', $enrollment->EnrollmentID) }}"class="btn btn-outline-warning btn-sm edit"><i
                                        class="bx bxs-edit"></i></a>
                                <form action="{{ route('enrollments.destroy', $enrollment->EnrollmentID) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm edit"
                                        onclick="return confirm('Are you sure you want to delete this enrollment?')"><i
                                            class="bx bxs-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="16" class="text-center">
                                <p class="font-size-15">No enrollments found...!</p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
        </table>
        <div class="float-end">
            <p>Total Records: <strong>{{$total}}</strong></p>
        </div>
    </div>
@endsection
