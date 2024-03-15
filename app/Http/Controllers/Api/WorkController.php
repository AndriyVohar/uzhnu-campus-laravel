<?php

namespace App\Http\Controllers\Api;

use App\Models\Work;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\WorkResource;
use App\Http\Resources\WorkBriefResource;
use Illuminate\Support\Arr;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $works = Work::orderByDesc('id')->where('status',1)->paginate(10);
        return response()->json([
            'data' => WorkBriefResource::collection($works),
            'last_page' => $works->lastPage(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:100',
            'tag'=>'required|max:50',
            'imgURL'=>'required',
            'salary'=>'required',
            'description'=>'required'
        ]);
        $work = Work::create($request->all());
        return response($work,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        return new WorkResource($work);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $work = Work::findOrFail($id);
        if($request->status==1){
            $user = User::findOrFail($request->user_id); 
            $role = Role::findOrFail($user->role_id);  
            if($role->role == 'commandant'||$role->role == 'admin'){
                $work->update(['status'=>$request->status]);
                return response()->json($work,200);
            }
        }
        // $request->validate([
        //     'title'=>'required|max:50',
        //     'tag'=>'required|max:20',
        //     'imgURL'=>'required',
        //     'salary'=>'required',
        //     'description'=>'required'
        // ]);
        // $work->update($request->all());
        // return new WorkResource($work);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        $work->delete();
        return response('', 204);
    }

    public function getWorksToApprove(){
        $works = Work::where('status',0)->orderByDesc('id')->get();
        return response()->json(['data' => WorkBriefResource::collection($works)], 200);
    }
}
