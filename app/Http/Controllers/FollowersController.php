<?php

namespace App\Http\Controllers;

use App\Models\Followers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function followers()
    {
        $followers = [];
        $users = User::all()->except(Auth::user()->id);
        foreach($users as $user) {
            if($user->isFollower()) {
                $followers[] = $user;
            }
        }
        return [
            'message'=> 'followers page',
            'followers'=> $followers,
        ];

        return response()->json([
            'message'=> 'followers page',
            'followers' => $followers
        ], 200);
    }
    public function following()
    {
        $following = [];
        $users = User::all()->except(Auth::user()->id);
        foreach($users as $user) {
            if($user->isFollowed()) {
                $following[] = $user;
            }
        }
        return response()->json([
            'message'=> 'following page',
            'following' => $following
        ], 200);
    }
    public function suggested()
    {
        $suggested = [];
        $users = User::all()->except(Auth::user()->id);
        foreach($users as $user) {
            if(!$user->isFollowed()) {
                $suggested[] = $user;
            }
        }
        return response()->json([
            'message'=> 'suggested_users',
            'suggested_users' => $suggested
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        $follows = Followers::create([
            'follower_id' => Auth::user()->id,
            'following_id' => $id,
        ]);

        return response()->json([
            'message'=> $follows,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $follower = Followers::where('following_id', $id)->where('follower_id', Auth::user()->id)->delete();

        return response()->json([
            'message'=> $follower,
        ], 200);
    }
}
