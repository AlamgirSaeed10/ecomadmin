@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Certificates</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="{{ route('certificates.create') }}"
                                class="btn btn-success mb-3 text-white">Create Certificate</a></li>
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
                    <th>Image</th>
                    <th>Certificate No</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Father Name</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                ?>
                @if (count($certificates) > 0)
                    @foreach ($certificates as $certificate)
                        <tr>
                            <td class="align-middle text-center" width="10%">
                                <img src="{{ asset('admin/assets/uploads/certificates') }}/{{ $certificate->CertificateImage }}"
                                    alt="" class="img-fluid">
                            <td class="align-middle text-center">{{ $certificate->CertificateNo }}</td>
                            <td class="align-middle text-center">{{ $certificate->StudentID }}</td>
                            <td class="align-middle text-center">
                                @php
                                    $total++;
                                    $studentData = DB::table('enrollment')
                                        ->where('StudentID', $certificate->StudentID)
                                        ->get();
                                @endphp
                                {{ $studentData[0]->StudentName }}
                            </td>
                            <td class="align-middle text-center">{{ $studentData[0]->FatherName }}</td>
                            <td class="align-middle text-center">
                                @php
                                    $courseData = DB::table('courses_offered')
                                        ->where('CourseCode', $certificate->CourseCode)
                                        ->get();
                                @endphp
                                {{ $courseData[0]->CourseCode }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $courseData[0]->CourseName }}
                            </td>
                            <td class="align-middle text-center">{{ $studentData[0]->EnrollmentStatus }}</td>
                            <td class="align-middle text-center" width="7%">
                                <a href="{{ route('certificates.show', $certificate->CertificateID) }}"
                                    class="btn btn-outline-info btn-sm edit"> <i class="bx bxs-show"></i></a>
                                <a href="{{ route('certificates.edit', $certificate->CertificateID) }}"
                                    class="btn btn-outline-warning btn-sm edit"> <i class="bx bxs-edit"></i></a>
                                <form action="{{ route('certificates.destroy', $certificate->CertificateID) }}"
                                    method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm edit"
                                        onclick="return confirm('Are you sure you want to delete this certificate?')"><i
                                            class="bx bxs-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" class="text-center">
                            <p class="font-size-15">No certificates found...!</p>
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
