<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function UsersListDashboard(){
        return inertia('Backend/Users', [
            'users'=>User::all(),
            'totalUsers' => User::count(),
            'totalActive' => User::where('status', 1)->count(),
            'totalInactive' => User::where('status', 0)->count(),
            'totalAdmins' => User::where('roles', 'admin')->count(),
        ]);
    }

    public function UsersStoreData(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'job_title' => 'required',
            'emp_id' => 'required',
            'roles' => 'required',
            'status' => 'required',
            'password' => 'required',
        ]);

        if($valid->fails()){
            return $this->StatusMessage(false, 'Error, Try Again');
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'job_title' => $request->job_title,
            'emp_id' => $request->emp_id,
            'roles' => $request->roles,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ]);

        return $this->StatusMessage(true, 'Success, User Registered');
    }

    public function userChangeStatus($id) {
        $user = User::findorfail($id);

        if($user->status === 1){
            $user->update(['status'=> 0]);
        }else if($user->status === 0){
            $user->update(['status' => 1]);
        }

        return $this->StatusMessage(true, 'Success, Account Status Changed!');
    }
}
