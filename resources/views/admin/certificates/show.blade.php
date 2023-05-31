@extends('layouts.app')
@section('content')
    <h1>Certificate Details</h1>
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
                <table class="table table-bordered border-dark">
                    <tbody>
                        <tr>
                            <th>Certificate No</th>
                            <td>{{ $certificate[0]->CertificateNo }}</td>
                        </tr>

                        <tr>
                            <th>Student Name</th>
                            <td>
                                @php
                                    $studentData = DB::table('enrollment')
                                        ->where('StudentID', $certificate[0]->StudentID)
                                        ->get();
                                @endphp
                                {{ $studentData[0]->StudentName }}
                            </td>
                        </tr>

                        <tr>
                            <th>Father Name</th>
                            <td>{{ $studentData[0]->FatherName }}</td>
                        </tr>
                        <tr>
                            <th>Course Code</th>
                            <td>
                                @php
                                    $courseData = DB::table('courses_offered')
                                        ->where('CourseCode', $certificate[0]->CourseCode)
                                        ->get();
                                @endphp
                                {{ $courseData[0]->CourseCode }}
                            </td>
                        </tr>
                        <tr>
                            <th>Course Name</th>
                            <td>{{ $courseData[0]->CourseName }}</td>
                        </tr>
                        <tr>
                            <th>Student ID:</th>
                            <td>{{ $certificate[0]->StudentID }}</td>
                        </tr>
                        <tr>
                            <th>Starting Date:</th>
                            <td>{{ date('d F Y', strtotime($certificate[0]->StartingDate)) }}</td>
                        </tr>
                        <tr>
                            <th>Completion Date:</th>
                            <td>{{ date('d F Y', strtotime($certificate[0]->CompilitionDate)) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <img src="{{ asset('admin/assets/uploads/certificates') }}/{{ $certificate[0]->CertificateImage }}" class="img-fluid" alt="">
            </div>
        </div>

    <a href="{{ route('certificates.index') }}" class="btn btn-primary">Back</a>
@endsection
