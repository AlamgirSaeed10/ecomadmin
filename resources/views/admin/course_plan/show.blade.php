@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Course Plan Details</h1>
    <div class="table-responsive">
                <table class="table table-bordered border-dark">
                    <tbody>
        <tr>
            <th>ID:</th>
            <td>{{ $coursePlan->PlanID }}</td>
        </tr>
        <tr>
            <th>Title:</th>
            <td>{{ $coursePlan->PlanTitle }}</td>
        </tr>
        <tr>
            <th>Description:</th>
            <td>{{ $coursePlan->PlanDescription }}</td>
        </tr>
        <tr>
            <th>Price PKR:</th>
            <td>{{ $coursePlan->PricePKR }}</td>
        </tr>
        <tr>
            <th>Price International:</th>
            <td>{{ $coursePlan->PriceInternational }}</td>
        </tr>
    </table>
    </div>

    <a href="{{ route('course_plan.index') }}" class="btn btn-info">Back</a>
</div>
@endsection
