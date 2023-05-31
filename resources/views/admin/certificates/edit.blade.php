@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Certificate</h1>
        @if (isset($errors) && count($errors))
        There were {{ count($errors->all()) }} Error(s)
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }} </li>
            @endforeach
        </ul>
    @endif
        <form action="{{ route('certificates.update', $certificate[0]->CertificateID) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="CertificateNo" id="certificateNo" class="form-control" value="{{ $certificate[0]->CertificateNo }}">
            <div class="mb-3 col-lg-8 col-sm-12 col-md-8 col-xl-8">
            <div class="row">

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
                <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label for="startingDate">Starting Date:</label>
                        <input type="date" name="StartingDate" id="startingDate" class="form-control"
                            value="{{ $certificate[0]->StartingDate }}">
                    </div>
                </div>
                <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label for="compilitionDate">Completion Date:</label>
                        <input type="date" name="CompilitionDate" id="compilitionDate" class="form-control"
                            value="{{ $certificate[0]->CompilitionDate }}">
                    </div>
                </div>
                <div class="mb-3 col-lg-12 col-sm-12 col-md-12 col-xl-12">
                    <div class="form-group">
                        <label for="certificateImage">Certificate Image:</label>
                        <input type="file" name="CertificateImage" id="certificateImage" class="form-control">
                    </div>
                </div>
                </div>

                <div class="mb-3 col-lg-4 col-sm-12 col-md-4 col-xl-4">
                    <div class="form-group">
                        <label for="certificateImage">Certificate Image:</label>
                        <img src="{{asset('admin/assets/uploads/certificates')}}/{{ $certificate[0]->CertificateImage }}" class="img-fluid">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('certificates.index') }}" class="btn btn-primary">Back</a>
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
