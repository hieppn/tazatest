<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Models\Group;
use App\Models\Message as ModelsMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    function chat(Request $request)
    {
        $group = Group::find($request->group_id);
        if (is_null($group)) {
            return response()->json(["message" => "Group not found!"], 404);
        }
        $user = User::find($request->user_id);
        $userJoin = DB::table('group_user')->where('user_id', $request->user_id)->get();
        if (is_null($user)||is_null($userJoin)) {
            return response()->json(["message" => "User not found!"], 404);
        }
        $request->validate([
            'message' => 'required'
        ]);
        $messsage = ModelsMessage::create($request->all());
        try {
            $messsage->load('user');
            broadcast(new Message($messsage))->toOthers();
        } catch (\Exception $e) {
            Log::error($e);
        }

        return $messsage->load('user')->load('group');
    }
}
