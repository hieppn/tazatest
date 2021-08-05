<?php

namespace App\Http\Controllers;

use App\Events\GroupCreated;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GroupController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:groups'
        ]);
        try {
            $group = Group::create($request->all());
            $users = collect($request->user_id);
            $group->users()->attach($users);
            event(new GroupCreated($group));
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $group;
    }
    public function join(Request $request)
    {
        $group = Group::find($request->group_id);
        if (is_null($group)) {
            return response()->json(["message" => "Group not found!"], 404);
        }
        $request->validate([
            'admin' => 'required'
        ]);
        $admin = DB::table('group_user')->where('user_id', '=', $request->admin)->where('group_id', $request->group_id)->first();
        if (is_null($admin)) {
            return response()->json(["message" => "Permission error"], 403);
        }
        $user = User::find($request->user_id);
        if (is_null($user)) {
            return response()->json(["message" => "User not found!"], 404);
        }
        $userJoin = DB::table('group_user')->where('user_id', $request->user_id)->where('group_id', $request->group_id)->first();
        if ($userJoin) {
            return response()->json(["message" => "User was existed!"], 400);
        }
        DB::table('group_user')->insert([
            "group_id" => $request->group_id,
            "user_id" => $request->user_id,
        ]);
        return response()->json([
            "message" => "success"
        ], 201);
    }
}
