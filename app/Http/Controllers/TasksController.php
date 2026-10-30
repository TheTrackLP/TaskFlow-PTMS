<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    public function TasksDashboard(){
        return inertia('Backend/Tasks', [
            'tasks' => tasks::select(
                '*',
                'projects.project_name',
                'users.name as user_name',
                )
            ->leftJoin('projects', 'projects.id', '=', 'tasks.project_id')
            ->leftJoin('users', 'users.id', '=', 'tasks.assigned_user')
            ->get(),
            'projects' => Projects::all(),
            'users' => User::all(),
        ]);
    }

    public function TaskStore(Request $request){
        $check = Validator::make($request->all(), [
            'task_name' => 'required',
            'task_desc' => 'required',
            'assigned_user' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'due_date' => 'required',
        ],
        [
            'task_name' => 'Title is required',
            'task_desc' => 'Description is required',
            'assigned_user' => 'User is required',
            'priority' => 'Priority is required',
            'status' => 'Status is required',
            'due_date' => 'Date Dute is required',
        ]
        );

        if($check->fails()){
            return $this->failedValidation($check);
        }

        tasks::create([
            'task_name' => $request->task_name,
            'task_desc' => $request->task_desc,
            'project_id' => $request->project_id,
            'assigned_user' => $request->assigned_user,
            'priority' => $request->priority,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return $this->StatusMessage(true, 'Success, Tasks Added!');
    }
}
