<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

use DB;


class EnrollmentController extends Controller
{

    public function index(){
        $enrollments = DB::table('enrollment')->get();
        return view('admin.enrollment.index', compact('enrollments'));
    }
    public function create(){
        return view('admin.enrollment.create');
    }
    public function store(Request $request){

        $en_data = $request->validate([
            'PlanID'=>'required',
            'CourseCode' =>'required',
            'StudentID'=>'required',
            'StudentName'=>'required',
            'FatherName'=>'required',
            'StudentCNIC'=>'required',
            'StudentPhone'=>'required',
            'StudentCity'=>'required',
            'StudentEmail'=>'required',
            'StudentGender'=>'required',
            'TrainingMode'=>'required',
            'PaymentOption'=>'required',
            'KnowAboutUs'=>'required',
        ]);
        $invoiceNo = Str::replaceFirst('STU', 'INV', $request->StudentID);
        $plan = DB::table('course_plan')->where('PlanID',$request->PlanID)->get();
        $enroll_cnic = DB::table('enrollment')->where('StudentCNIC',$request->StudentCNIC)->get();

        $inv_data = [
            'InvoiceNo' => $invoiceNo,
            'PaymantAmount'=>$plan[0]->PricePKR,
            'PaymentType' => $request->PaymentOption,
            'PaymantDate' =>Carbon::now()->addDays(7)->format('Y-m-d'),
            'PaymentStatus' =>'Pending',
            'PlanType' =>$plan[0]->PlanType,
            'StudentID' =>$request->StudentID,
            'CourseCode' =>$request->CourseCode,
        ];


        if(count($enroll_cnic) > 0 ){
            return redirect()->route('enrollments.index')->with('error', 'Student already registered with this CNIC.');
        }


   if(count($en_data) > 0 && count($inv_data) > 0){
        DB::table('enrollment')->insert($en_data);
        DB::table('course_payment')->insert($inv_data);
        return redirect()->route('enrollments.index')->with('success', 'Enrollment created successfully');
    }
     else{
        return redirect()->route('enrollments.index')->with('error', 'Error During enrollment... Please contact administrator');
    }

    }
    public function show($id)
    {
        $enrollment = DB::table('enrollment')->where('EnrollmentID', $id)->first();

        return view('admin.enrollment.show', compact('enrollment'));
    }
    public function edit($id)
    {
        $enrollment = DB::table('enrollment')->where('EnrollmentID', $id)->first();

        return view('admin.enrollment.edit', compact('enrollment'));
    }
    public function update(Request $request, $id){
        $data = $request->validate([
            'PlanID'=>'required',
            'CourseCode' =>'required',
            'StudentID'=>'required',
            'StudentName' =>'required',
            'FatherName'=>'required',
            'StudentCNIC'=>'required',
            'StudentPhone'=>'required',
            'StudentCity'=>'required',
            'StudentEmail'=>'required',
            'StudentGender'=>'required',
            'TrainingMode'=>'required',
            'PaymentOption'=>'required',
            'KnowAboutUs'=>'required',
            'EnrollmentStatus'=>'required',
        ]);

        DB::table('enrollment')->where('EnrollmentID', $id)->update($data);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully');
    }
    public function destroy($id)
    {
        DB::table('enrollment')->where('EnrollmentID', $id)->delete();

        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully');
    }



    public function enrollmentData()
    {
        // Fetch enrollment data from the database using raw SQL queries
        $enrollments = DB::select('SELECT * FROM enrollment');
        $courses = DB::select('SELECT * FROM courses_offered');

        // Process the data to match the required format
        $enrollmentData = [];

        foreach ($courses as $course) {
            $enrollmentCount = 0;

            foreach ($enrollments as $enrollment) {
                if ($enrollment->CourseID == $course->CourseID) {
                    $enrollmentCount++;
                }
            }

            $enrollmentData[] = [
                'courseId' => $course->CourseID,
                'count' => $enrollmentCount,
            ];
        }

        // Prepare the response data
        $responseData = [
            'courses' => $courses,
            'enrollments' => $enrollmentData,
        ];

        // Return the JSON response
        return response()->json($responseData);
    }
}
