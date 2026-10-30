<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    public function ProjectsDashboard(){
        return inertia('Backend/Projects', [
            'projects' => Projects::all(),
        ]);
    }

    public function ProjectsStore(Request $request){
        $check = Validator::make($request->all(),[
            'project_name' => "required",
            'project_desc' => "required",
            'status' => "required",
        ],
        [
            'project_name' => "Project name is required",
            'project_desc' => "Project name is required",
            'status' => "Status is required",
        ]
        );

        if($check->fails()){
            return $this->failedValidation($check);
        }

        Projects::create([
            'project_name' => $request->project_name,
            'project_desc' => $request->project_desc,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'due_date' => $request->due_date,
            'created_by' => Auth::user()->id,
        ]);

        return $this->StatusMessage(true, 'Success, Project Added!');
    }


    public function ProjectsUpdate(Request $request){
        $check = Validator::make($request->all(), [
            'project_name' => "required",
            'project_desc' => "required",
            'status' => "required",
        ]);

        if($check->fails()){
            return $this->failedValidation($check);
        }

        Projects::findorfail($request->id)->update([
            'project_name' => $request->project_name,
            'project_desc' => $request->project_desc,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'due_date' => $request->due_date,
        ]);

        return $this->StatusMessage(true, "Success, Project Updated!");
    }
}
