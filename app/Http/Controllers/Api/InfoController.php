<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InfoResource;
use Illuminate\Http\Request;
use App\Models\Info;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return InfoResource::collection(Info::query()->orderByDesc('id')->get());
        // TODO: ->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:50',
            'description'=>'required',
            'dormitory'=>'required'
        ]);
        $info = Info::create($request->all());
        return response($info,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Info $info)
    {
        return new InfoResource($info);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Info $info)
    {
        $request->validate([
            'title'=>'required|max:50',
            'description'=>'required'
        ]);
        $info->update($request->all());
        return new InfoResource($info);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Info $info)
    {
        $info->delete();
        return response('', 204);
    }
    public function getInfosByDormitory($dormitory){
       $infos = Info::orderBy('id','desc')->where('dormitory',$dormitory)->get();
       return InfoResource::collection($infos); 
    }
}
