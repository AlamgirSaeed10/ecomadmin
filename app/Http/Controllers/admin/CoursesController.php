<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;



class CoursesController extends Controller
{
    public function index()
    {
        $courses = DB::table('courses_offered')->get();

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'CourseCode' => 'required',
            'CourseName' => 'required',
            'CourseImage' => 'required',
            'CourseDescription' => 'required',
            'CourseStartDate' => 'required|date',
            'CourseEndDate' => 'required|date',
        ]);
        $image = $request->file('CourseImage');
        $cleanedName = $request->CourseCode.'.'.$image->getClientOriginalExtension();
        $imageName = str_replace(' ', ' ', $cleanedName);
        $image->move(public_path('admin/assets/uploads/courses/'), $imageName);

        $courseData = [
            'CourseCode' =>$request->CourseCode,
            'CourseName' =>$request->CourseName,
            'CourseImage' =>$imageName,
            'CourseDescription' =>$request->CourseDescription,
            'CourseStartDate' =>$request->CourseStartDate,
            'CourseEndDate' =>$request->CourseEndDate,
                ];
        DB::table('courses_offered')->insert($courseData);

        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }

    public function show($id)
    {
        $course = DB::table('courses_offered')->where('CourseID', $id)->first();

        return view('admin.courses.show', compact('course'));
    }

    public function edit($id)
    {
        $course = DB::table('courses_offered')->where('CourseID', $id)->first();

        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {

        $image = $request->file('CourseImage');
        $request->validate([
            'CourseCode' => 'required',
            'CourseName' => 'required',
            'CourseDescription' => 'required',
            'CourseStartDate' => 'required|date',
            'CourseEndDate' => 'required|date',
            'CourseImage' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);


        $courseData = [
            'CourseCode' => $request->CourseCode,
            'CourseName' => $request->CourseName,
            'CourseDescription' => $request->CourseDescription,
            'CourseStartDate' => $request->CourseStartDate,
            'CourseEndDate' => $request->CourseEndDate,
        ];

        if ($image) {
            $cleanedName = $request->CourseCode . '.' . $image->getClientOriginalExtension();
            $imageName = str_replace(' ', ' ', $cleanedName);
            $image->move(public_path('admin/assets/uploads/courses/'), $imageName);
            $courseData['CourseImage'] = $imageName;
        } else {
            $previousImageName = DB::table('courses_offered')->where('CourseID', $id)->get();
            $courseData['CourseImage'] = $previousImageName[0]->CourseImage;
        }

        DB::table('courses_offered')->where('CourseID', $id)->update($courseData);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }

    public function destroy($id)
    {
        DB::table('courses_offered')->where('CourseID', $id)->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully');
    }

    public function getCourses(Request $request)
{
    $studentId = $request->input('StudentID');
    $courses = DB::table('enrollment')->where('StudentID', $studentId)->pluck('StudentName', 'StudentID');
    return response()->json(['courses' => $courses]);
}

}
