<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;


class CertificatesController extends Controller
{
    public function index(){
        $certificates = DB::table('certificates')->get();

        return view('admin.certificates.index', compact('certificates'));
    }
    public function create(){
        return view('admin.certificates.create');
    }
    public function store(Request $request){

        $request->validate([
            'CertificateNo' => 'required',
        ]);


        $dates = DB::table('courses_offered')->where('CourseCode',$request->CourseCode)->get();
        $image = $request->file('CertificateImage');

        $cleanedName = $request->StudentID.'.'.$image->getClientOriginalExtension();
        $imageName = str_replace(' ', ' ', $cleanedName);
        $image->move(public_path('admin/assets/uploads/certificates/'), $imageName);
        $data =array(
            'CertificateNo' => $request->CertificateNo,
            'CourseCode' => $request->CourseCode,
            'StudentID' => $request->StudentID,
            'StartingDate' => $dates[0]->CourseStartDate,
            'CompilitionDate' => $dates[0]->CourseEndDate,
            'CertificateImage' => $imageName,
        );

        $dd = DB::table('certificates')
        ->select('*')
        ->where('StudentID','=',$request->StudentID)
        ->where('CourseCode','=',$request->CourseCode)
        ->get();
        if(count($dd) > 0){
            return redirect()->route('certificates.index')->with('error', 'Certificates already exists for Student ID ['.$request->StudentID.']');
        }else{
            DB::table('certificates')->insert($data);
            return redirect()->route('certificates.index')->with('success', 'Certificates created successfully for Student ID ['.$request->StudentID.']');;
        }
    }
    public function show($id){
        $certificate = DB::table('certificates')->where('CertificateID','=',$id)->get();

        // dd($certificate);


        return view('admin.certificates.show', compact('certificate'));
    }
    public function edit($id){
        $certificate = DB::table('certificates')->where('CertificateID','=',$id)->get();
        return view('admin.certificates.edit', compact('certificate'));
    }
    public function update(Request $request, $id) {
        $request->validate([
            'CertificateNo' => 'required',
            'CourseID' => 'required',
            'StudentID' => 'required',
            'StartingDate' => 'required',
            'CompilitionDate' => 'required',
            'CertificateImage' => 'required',
        ]);

        $image = $request->file('CertificateImage');

        $cleanedName = $request->StudentID.'-'.$request->CourseID.'.'.$image->getClientOriginalExtension();
        $imageName = str_replace(' ', ' ', $cleanedName);
        $image->move(public_path('admin/assets/uploads/certificates/'), $imageName);
        $data =array(
            'CertificateNo' => $request->CertificateNo,
            'CourseID' => $request->CourseID,
            'StudentID' => $request->StudentID,
            'StartingDate' => $request->StartingDate,
            'CompilitionDate' => $request->CompilitionDate,
            'CertificateImage' => $imageName,
        );

        DB::table('certificates')->where('CertificateID', $id)->update($data);

        return redirect()->route('certificates.index')->with('success','Certificate data has been updated successfully...!');
    }
    public function destroy($id){
        DB::table('certificates')->where('CertificateID', $id)->delete();

        return redirect()->route('certificates.index');
    }
    public function getStudentData($studentID){
        $studentData = DB::table('enrollment')->where('StudentID', $studentID)->get();
        $course = DB::table('courses_offered')->where('CourseCode', $studentData[0]->CourseCode)->get();
            $options = "";
            foreach ($course as $data) {
                $options .= "<option value='$data->CourseCode'>$data->CourseName</option>";
            }
            $selectBox = "<select class='form-control select2' required>";
            $selectBox .= $options;
            $selectBox .= "</select>";
            return response()->json($selectBox);

    }


}
