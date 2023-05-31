@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Course Plan</h1>

        <form action="{{ route('course_plan.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label for="planTitle">Title</label>
                        <input type="text" name="PlanTitle" placeholder="Enter Plan Title" id="planTitle" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label for="pricePKR">Price PKR</label>
                        <input type="number" name="PricePKR" placeholder="Enter Price PKR" id="pricePKR" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label for="priceInternational">Price International (<strong>$</strong>)</label>
                        <input type="number" name="PriceInternational" placeholder="Enter Price International" id="priceInternational" class="form-control"
                            required>
                    </div>
                </div>
                <div class="mb-3 col-lg-6 col-sm-12 col-md-6 col-xl-6">
                    <div class="form-group">
                        <label for="planDescription">Description</label>
                        <textarea name="PlanDescription" id="planDescription" placeholder="Enter plan Description" class="form-control" required></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('course_plan.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
