<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', 1)->get();
        
        return view('user.index', compact('users'));
    }

    public function showRegistrationForm()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        if($validate->fails()){
            return back()->withErrors($validate);
        }

        $create_user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        if($create_user){
            return redirect('register')->with(['message' => 'User created successfully']);
        }
    }

    public function changePassword()
    {
        return view('user.password');
    }

    public function password(Request $request)
    {
        if(Hash::check($request->old_password, auth()->user()->password)){
            $validate = Validator::make($request->all(),[
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
    
            if($validate->fails()){
                return back()->withErrors($validate);
            }
    
            $update_password = User::where('id', auth()->user()->id)->update(['password' => Hash::make($request->password)]);
    
            if($update_password){
                return redirect('change-password')->with(['success' => 'True', 'message' => 'Your Password has beed Changed successfully']);
            }
        }
        
        return redirect('change-password')->with(['success' => 'False', 'message' => 'The Old password you have entered is incorrect']);
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();

        if(!isset($user)){
            return redirect('users')->with(['success' => 'False', 'message' => 'User does not exist']);
        }

        return redirect('users')->with(['success' => 'True', 'message' => 'User deleted successfully']);
    }
}
