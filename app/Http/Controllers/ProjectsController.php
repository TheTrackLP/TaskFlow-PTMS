<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    // private function StatusMessage(bool $status, string $message){
    //     return redirect()->route('project.dash')->with($status ? 'success' : 'error', $message);
    // }

    private function returnErrorMessage(array $trying){
        return back()->withErrors($trying);
    }

    public function ProjectsDashboard(){
        return inertia('Backend/Projects');
    }

    public function ProjectsStore(Request $request){
        $check = Validator::make($request->all(),[
            'project_name' => "required",
            'project_desc' => "required",
            'status' => "required",
            'start_date' => "required",
            'due_date' => "required",
        ]);

        if($check->fails()){
            return $this->returnErrorMessage($check);
        }

        // Projects::create([
        //     'project_name' => $request->project_name,
        //     'project_desc' => $request->project_desc,
        //     'status' => $request->status,
        //     'start_date' => $request->start_date,
        //     'due_date' => $request->due_date,
        //     'created_by' => Auth::user()->id,
        // ]);

        // return $this->StatusMessage(true, 'Success, Project Added!');
    }
}
