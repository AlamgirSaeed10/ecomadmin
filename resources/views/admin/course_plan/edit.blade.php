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
        <form action="{{ route('course_plan.update', $coursePlan->PlanID) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
            <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
            <div class="form-group">
                <label for="planTitle">Title:</label>
                <input type="text" name="PlanTitle" id="planTitle" class="form-control" value="{{ $coursePlan->PlanTitle }}"
                    required>
            </div>
            </div>
            <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
                <div class="form-group">
                    <label for="pricePKR">Price PKR:</label>
                    <input type="number" name="PricePKR" id="pricePKR" class="form-control"
                    value="{{ $coursePlan->PricePKR }}" required>
                </div>
            </div>
            <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
                <div class="form-group">
                    <label for="priceInternational">Price International:</label>
                    <input type="number" name="PriceInternational" id="priceInternational" class="form-control"
                    value="{{ $coursePlan->PriceInternational }}" required>
                </div>
            </div>
            <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
            <div class="form-group">
                <label for="planDescription">Description:</label>
                <textarea name="PlanDescription" id="planDescription" class="form-control" required>{{ $coursePlan->PlanDescription }}</textarea>
            </div>
            </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('course_plan.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
