<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Washing;
use Illuminate\Http\Request;
use App\Http\Resources\WashingResource;

class WashingController extends Controller
{
    public function getWashingDay($dormitory, $washing_machine_num, $day)
    {
        $washing = Washing::where('dormitory', $dormitory)
            ->where('washing_machine_num', $washing_machine_num)
            ->where('day', $day)
            ->with('creator')
            ->get();
        return response()->json(WashingResource::collection($washing), 200);
    }
    public function index()
    {
        $washings = Washing::orderBy('id','desc')->with('creator')->get();
        return response()->json(WashingResource::collection($washings), 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'day'=>'required',
            'dormitory'=>'required|max:5',
            'washing_machine_num'=>'required|max:5',
            'hour'=>'required',
            'user_id'=>'required'
        ]);
        $washing = Washing::create($request->all());
        return response()->json($washing,201);
    }
    public function show($id)
    {
        $washing = Washing::with('creator')->findOrFail($id);
        return $washing;
    }
    public function update(Request $request, Washing $washing)
    {
        $request->validate([
            'day'=>'required',
            'dormitory'=>'required|max:5',
            'washing_machine_num'=>'required|max:5',
            'hour'=>'required',
            'user_id'=>'required'
        ]);
        $washing->update($request->all());
        return new WashingResource($washing);
    }
    public function destroy(Washing $washing)
    {
        $washing->delete();
        return response(200);
    }
}
