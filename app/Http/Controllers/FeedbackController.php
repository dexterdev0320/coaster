<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        // dd($feedbacks);
        return view('feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
