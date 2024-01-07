<?php

namespace App\Http\Controllers\Api;

use App\Models\Work;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\WorkResource;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return WorkResource::collection(Work::query()->orderByDesc('id')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:50',
            'tag'=>'required|max:20',
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
    public function update(Request $request, Work $work)
    {
        $request->validate([
            'title'=>'required|max:50',
            'tag'=>'required|max:20',
            'imgURL'=>'required',
            'salary'=>'required',
            'description'=>'required'
        ]);
        $work->update($request->all());
        return new WorkResource($work);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        $work->delete();
        return response('', 204);
    }
}
