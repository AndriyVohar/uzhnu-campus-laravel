<?php

namespace App\Http\Controllers\Api;

use App\Models\Work;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Work::all();
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
        return $work;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Work::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required|max:50',
            'tag'=>'required|max:20',
            'imgURL'=>'required',
            'salary'=>'required',
            'description'=>'required'
        ]);
        $work = Work::findOrFail($id);
        $work->update($request->all());
        return $work;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $work = Work::findOrFail($id);
        $work->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
