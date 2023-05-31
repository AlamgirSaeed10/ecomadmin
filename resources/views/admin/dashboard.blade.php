@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Certificates</h5>
                        <p class="card-text">Manage certificates and their details.</p>
                        <form id="" action="{{ route('send-email') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Send Email </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Courses</h5>
                        <p class="card-text">Manage courses and their details.</p>
                        <a href="{{ route('courses.index') }}" class="btn btn-primary">Go to Courses</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Enrollments</h5>
                        <p class="card-text">Manage enrollments and student details.</p>
                        <a href="{{ route('enrollments.index') }}" class="btn btn-primary">Go to Enrollments</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Course Plans</h5>
                        <p class="card-text">Manage course plans and pricing.</p>
                        <a href="{{ route('course_plan.index') }}" class="btn btn-primary">Go to Course Plans</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
