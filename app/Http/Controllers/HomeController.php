<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\EnrollmentRequest;
use App\Http\Requests\MaintenanceRequest;
use App\Mail\ContactMail;
use App\Mail\ContactUsMail;
use App\Mail\SendMail;
use App\Models\Contact;
use App\Models\Enrollment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Expectation;
use Illuminate\Support\Str;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('ecom.index');
    }

    public function About()
    {
        return view('ecom.about');
    }
    public function enrollment()
    {
        return view('ecom.enrollment');
    }

    public function post_enrollment(EnrollmentRequest $request)
    {
        if (!$request->validated()) {
            // return response()->json(['success' => $request->all()]);
            $errors = $request->errors();
            return response()->json(['errors' => $errors]);
        }
        $data = $request->all();
        // dd($data);
        foreach ($request->course_selected as $course_selected) {
            if (!is_null($course_selected)) {
                $course_id[] = $course_selected;
            }
        }
        $data['course_id'] = ucwords(json_encode($course_id));
        $data['enrollment_code'] = 'enc-' . random_int(10000000000, 99999999999);
        $data['status'] = "Pending";
        // dd($course_id);
        if ($request->file('attach_doc')) {
            $attach_doc = $request->file('attach_doc');
            $path = $attach_doc->store('temp');
            // $file = public_path('attachments/'.$request->attach_doc);
        }
        // dd($data);
        $enrollment = Enrollment::create($data);
        $enrollment->update(['course_id' => $data['course_id']]);
        if ($enrollment) {
            if ($request->file('attach_doc')) {
                $mail = Mail::to(env('MAIL_FROM_ADDRESS'))->send((new SendMail($data))->attach(
                    $attach_doc->getRealPath(),
                    [
                        'as' => $attach_doc->getClientOriginalName(),
                        'mime' => $attach_doc->getClientMimeType(),
                    ]
                ));
                // $mail->attach(storage_path('app/' . $path), [
                //     'as' => $attach_doc->getClientOriginalName(),
                //     'mime' => $attach_doc->getClientMimeType(),
                // ]);
                // Delete the temporary file
                Storage::delete($path);
            } else {
                Mail::to(env('MAIL_FROM_ADDRESS'))->send(new SendMail($data));
            }
        }
        return response()->json([
            'success' => 'Enrollment form submitted successfully, We will contact you soon'
        ]);
        // return view('enrollment');
    }
    public function contact()
    {
        return view('ecom.contact');
    }

    // Contact form on contact blade
    public function contact_us_mail(ContactRequest $request)
    {
        if (!$request->validated()) {
            // return response()->json(['success' => $request->all()]);
            $errors = $request->errors();
            return response()->json(['errors' => $errors]);
        }
        $data = $request->all();
        $contact = Contact::create($data);
        if ($contact) {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactMail($data));
        }

        return redirect()->back()
            ->with(['success' => 'Thank you for contacting us. We will contact you shortly.']);
    }

    public function maintenance()
    {
        return view('maintenance');
    }

    // Contact form on maintenance page
    public function contactUsEmail(MaintenanceRequest $request)
    {
        if (!$request->validated()) {
            // return response()->json(['success' => $request->all()]);
            $errors = $request->errors();
            return response()->json(['errors' => $errors]);
        }

        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactUsMail($request->all()));


        return redirect()->back()->with('success', 'Thank you for contacting us. We will contact you shortly.');
    }

    function verify_certificate(Request $request){
        $CertificateNo = $request->CertificateNo;
        $verify = DB::table('certificates')->where('CertificateVerificationCode',$CertificateNo)->get();

        return view('ecom.verify-certificate.verify-certificate',compact('verify'));
    }

    function certificate(){
        return view('ecom.verify-certificate.certificate');
    }

}
