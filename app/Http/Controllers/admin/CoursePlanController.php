<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class CoursePlanController extends Controller
{
    public function index()
    {
        $coursePlans = DB::table('course_plan')->get();
        return view('admin.course_plan.index', compact('coursePlans'));
    }

    public function create()
    {
        return view('admin.course_plan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'PlanTitle' => 'required',
            'PlanDescription' => 'required',
            'PricePKR' => 'required|numeric',
            'PriceInternational' => 'required|numeric',
        ]);

        DB::table('course_plan')->insert($data);
        return redirect()->route('course_plan.index')->with('success', 'Course plan created successfully.');
    }

    public function show($id)
    {
        $coursePlan = DB::table('course_plan')->where('PlanID', $id)->first();
        return view('admin.course_plan.show', compact('coursePlan'));
    }

    public function edit($id)
    {
        $coursePlan = DB::table('course_plan')->where('PlanID', $id)->first();
        return view('admin.course_plan.edit', compact('coursePlan'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'PlanTitle' => 'required',
            'PlanDescription' => 'required',
            'PricePKR' => 'required|numeric',
            'PriceInternational' => 'required|numeric',
        ]);

        DB::table('course_plan')->where('PlanID', $id)->update($data);
        return redirect()->route('course_plan.index')->with('success', 'Course plan updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('course_plan')->where('PlanID', $id)->delete();
        return redirect()->route('course_plan.index')->with('success', 'Course plan deleted successfully.');
    }
}
