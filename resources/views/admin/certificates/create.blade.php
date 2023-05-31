@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Create Certificate</h1>
        @if (isset($errors) && count($errors))
            There were {{ count($errors->all()) }} Error(s)
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }} </li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('certificates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @php
                    $certID = 'CERT-' . date('dY') . strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 1));
                    $existingID = DB::table('enrollment')
                        ->where('StudentID', $certID)
                        ->exists();
                    if ($existingID) {
                        $certID = 'CERT-' . date('dY') . strtoupper(substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 1));
                    }
                @endphp
                <input type="hidden" name="CertificateNo" id="certificateNo" class="form-control" value="{{ $certID }}">

                <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
                    <label for="example-text-input">Select Student</label>
                    <select id="student-select" class="form-control select2" name="StudentID" required>
                        @php
                            $StudentData = DB::Table('enrollment')->get();
                        @endphp
                        @foreach ($StudentData as $key => $value)
                            <option value="{{ $value->StudentID }}">{{ $value->StudentName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
                    <label for="example-text-input">Select Course</label>
                    <select id="courses" class="form-control select2" name="CourseCode" required></select>
                </div>
                <div class="mb-3 col-lg-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="form-group">
                        <label for="CertificateImage">Certificate Image:</label>
                        <input type="file" name="CertificateImage" accept="image/*" id="CertificateImage" class="form-control">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#student-select').change(function() {
                var studentID = $(this).val();
                if (studentID == "") {
                    $('#courses').hide();
                    return;
                }
                $.ajax({
                    url: "{{ url('admin/getStudentData') }}/" + studentID,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#courses').html('');
                        $('#courses').html(response);
                        $('#courses').show();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log('Error: ' + errorThrown);
                    }
                });

            });
        });
    </script>
@endsection
