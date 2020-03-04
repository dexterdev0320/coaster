<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'DESC')->get();

        return view('feedback.index', compact('feedbacks'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'emp_id' => 'required',
            'comment' => 'required',
        ]);

        $employee = Employee::where('emp_id', $request->emp_id)->first();
        if($employee){
            $feedback = Feedback::create([
                'employee_id' => $employee->id,
                'feedback' => $request->comment,
            ]);

            if($feedback){
                return response()->json(['success' => true, 'message' => 'Feedback send successfully']);
            }
        }

        return response()->json(['success' => false, 'message' => 'The Employee ID you have entered does not exist']);
    }

}
