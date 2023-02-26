<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\SignUpRequest;
use App\Http\Requests\Frontend\InstructorSignUpRequest;
use App\Mail\UserEnailVerificaion;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\User;
use App\Tools\Repositories\Crud;
use App\Traits\EmailSendTrait;
use App\Traits\General;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Traits\ImageSaveTrait;
use App\Traits\SendNotification;

class RegistrationController extends Controller
{
    use EmailSendTrait, General, ImageSaveTrait, SendNotification;

    protected $model;
    protected $studentModel;
    protected $instructorModel;

    public function __construct(User $user, Student $student, Instructor $instructor)
    {
        $this->model = new Crud($user);
        $this->studentModel = new Crud($student);
        $this->instructorModel = new Crud($instructor);
    }


    public function signUp()
    {
        $data['pageTitle'] = 'Sign Up';
        return view('auth.sign-up', $data);
    }

    public function signUpInstructor()
    {
        $data['pageTitle'] = 'Instructor Sign Up';
        return view('auth.instructor-sign-up', $data);
    }

    public function storeSignUp(SignUpRequest $request)
    {
        $user = new User();
        $user->name = $request->first_name . ' '. $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = $request->_token;
        $user->email_verified_at = get_option('registration_email_verification') == 1 ? '' : now();
        $user->role = 3;
        $user->save();

        $student_data = [
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ];

        $this->studentModel->create($student_data);

        if (get_option('registration_email_verification') == 1){
            try {
                Mail::to($user->email)->send(new UserEnailVerificaion($user));
            } catch (\Exception $exception) {
                toastrMessage('error', 'Something is wrong. Try after few minutes!');
                return redirect()->back();
            }
            $this->showToastrMessage('error', 'Sent verification mail your account. Please check your email.');
        }
        $this->showToastrMessage('success', 'Your registration is successful.');
        return redirect(route('login'));
    }

    public function storeInstructorSignUp(InstructorSignUpRequest $request)
    {
        $user = new User();
        $user->name = $request->first_name . ' '. $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = $request->_token;
        $user->email_verified_at = get_option('registration_email_verification') == 1 ? '' : now();
        $user->role = 2;
        $user->save();

        $cv_file_data = $this->uploadFileWithDetails('user', $request->cv_file);

        $instructor_data = [
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'professional_title' => $request->professional_title,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'about_me' => $request->about_me,
            'cv_file' => $cv_file_data['path'],
            'cv_filename' => $cv_file_data['original_filename'],
        ];

        $this->instructorModel->create($instructor_data);

        $text = "New instructor request";
        $target_url = route('instructor.pending');
        $this->send($text, 1, $target_url, null);

        $this->showToastrMessage('success', 'Request successfully send');

        if (get_option('registration_email_verification') == 1){
            try {
                Mail::to($user->email)->send(new UserEnailVerificaion($user));
            } catch (\Exception $exception) {
                toastrMessage('error', 'Something is wrong. Try after few minutes!');
                return redirect()->back();
            }
            $this->showToastrMessage('error', 'Sent verification mail your account. Please check your email.');
        }

        return redirect(route('login'));
    }


    public function emailVerification($token)
    {
        if (User::where('remember_token', $token)->count() > 0)
        {
            $user = User::where('remember_token', $token)->first();
            $user->email_verified_at = Carbon::now()->format("Y-m-d H:i:s");
            $user->remember_token = null;
            $user->save();
            Auth::login($user);

            $this->showToastrMessage('success', 'Congratulations! Successfully verified your email.');
            return redirect()->route('home');

        } else {
            return redirect(route('login'));
        }

    }

}
