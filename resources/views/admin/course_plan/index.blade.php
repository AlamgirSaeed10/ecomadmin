@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Course Plan</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active"><a href="{{ route('course_plan.create') }}" class="btn btn-success mb-3 text-white">Create Course Plan</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@elseif (session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="table-responsive">
<table class="table table-bordered border-dark  ">
    <thead class="bg-dark text-white">
        <tr class="text-center">
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price PKR</th>
            <th>Price International</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody> <?php
        $total = 0;
            ?>
        @if(count($coursePlans) > 0)
        @foreach ($coursePlans as $key=> $coursePlan)
        <?php $total++; ?>
            <tr>
                <td class="align-middle text-center" width="3%"><strong>{{ ++$key}}</strong></td>
                <td class="align-middle text-center">{{ $coursePlan->PlanTitle }}</td>
                <td class="align-middle text-center">{{ $coursePlan->PlanDescription }}</td>
                <td class="align-middle text-center">{{ $coursePlan->PricePKR }}</td>
                <td class="align-middle text-center">{{ $coursePlan->PriceInternational }}</td>
                <td class="align-middle text-center" width="7%">
                    <a href="{{ route('course_plan.show', $coursePlan->PlanID) }}" class="btn btn-outline-info btn-sm edit"><i class="bx bxs-show"></i></a>
                    <a href="{{ route('course_plan.edit', $coursePlan->PlanID) }}" class="btn btn-outline-warning btn-sm edit"><i class="bx bxs-edit"></i></a>
                    <form action="{{ route('course_plan.destroy', $coursePlan->PlanID) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm edit" onclick="return confirm('Are you sure you want to delete this course plan?')"><i class="bx bxs-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        @else
        <tr>
            <td  colspan="6" class="text-center">
                <p class="font-size-15">No course plan found.</p>
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
