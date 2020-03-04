<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Employee;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();

        return view('feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
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

    public function show(Feedback $feedback)
    {
        //
    }

    public function edit(Feedback $feedback)
    {
        //
    }

    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    public function destroy(Feedback $feedback)
    {
        //
    }
}
