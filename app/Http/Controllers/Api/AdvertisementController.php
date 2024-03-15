<?php

namespace App\Http\Controllers\Api;

use App\Models\Advertisement;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AdvertisementResource;
use App\Http\Resources\AdvertisementBriefResource;
use Illuminate\Support\Arr;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AdvertisementBriefResource::collection(Advertisement::query()->orderBy('id', 'desc')->with('creator')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'tag' => 'required|max:20',
            'imgURL' => 'required',
            'user_id' => 'required',
        ]);
        $advertisement = Advertisement::create($request->all());
        return response($advertisement, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return new AdvertisementResource(Advertisement::with('creator')->find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $advertisement = Advertisement::findOrFail($id);
        if($request->status==1){
            $user = User::findOrFail($request->user_id); 
            $role = Role::findOrFail($user->role_id);  
            if($role->role == 'commandant'||$role->role == 'admin'){
                $advertisement->update(['status'=>$request->status]);        
                return response()->json($advertisement,200);
            }
        }else{
            $request->validate([
                'title' => 'required|max:100',
                'tag' => 'required|max:50',
                'imgURL' => 'required',
            ]);
            $advertisement->update(array_merge($request->all(),['status'=>0]));
            return response()->json($advertisement,200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
        return response('', 204);
    }

    public function getAdvertisementsByDormitory($dormitory)
    {
        $advertisements = Advertisement::orderBy('id', 'desc')
            ->whereHas('creator', function ($query) use ($dormitory) {
                $query->where('dormitory', $dormitory);
            })->where('status',1)->paginate(10);

        return response()->json([
            'data' => AdvertisementBriefResource::collection($advertisements),
            'last_page' => $advertisements->lastPage(),
        ],200);
    }
    public function getAdvertisementsByDormitoryApprove($dormitory)
    {
        $advertisements = Advertisement::whereHas('creator', function ($query) use ($dormitory) {
                $query->where('dormitory', $dormitory);
            })->where('status',0)->get();

        return response()->json([
            'data' => AdvertisementBriefResource::collection($advertisements),
        ],200);
    }
}
