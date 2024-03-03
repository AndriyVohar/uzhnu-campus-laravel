<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkerTaskResource;
use App\Models\WorkerTask;
use App\Models\Role;
use Illuminate\Http\Request;

class WorkerTaskController extends Controller
{
    public function getWorkerTasksByDormitory($dormitory, $worker)
    {
        $worker = Role::where('role', $worker)->first();
        $worker_id = $worker->id;

        $workerTask = WorkerTask::orderBy('id', 'desc')
            ->where('worker_id', $worker_id)
            ->where('status', 0)
            ->whereHas('creator', function ($query) use ($dormitory) {
                $query->where('dormitory', $dormitory);
            })
            ->get();
        return WorkerTaskResource::collection($workerTask);
    }

    public function index()
    {
        $WorkerTasks = WorkerTask::orderBy('id', 'desc')->with('creator')->get();
        return response()->json(WorkerTaskResource::collection($WorkerTasks), 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'user_id' => 'required',
            'worker' => 'required',
        ]);
        $requestTask = $request->all();
        $worker = Role::where('role', $requestTask['worker'])->first();
        $requestTask['worker_id'] = $worker->id;
        $workerTask = WorkerTask::create($requestTask);
        return response()->json($workerTask, 201);
    }

    public function show($id)
    {
        $WorkerTask = WorkerTask::with('creator')->findOrFail($id);
        return $WorkerTask;
    }
    public function update(Request $request, WorkerTask $WorkerTask)
    {
        $request->validate([
            'status'=>'required'
        ]);
        $WorkerTask->update($request->all());
        return $WorkerTask;
    }
    public function destroy(WorkerTask $WorkerTask)
    {
        $WorkerTask->update(['status'=>1]);
        return response(200);
    }
}
