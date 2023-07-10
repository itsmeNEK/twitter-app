<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $followed_tweets = [];
        $all_tweets = Tweet::with('users')->latest()->get();
        foreach($all_tweets as $tweet) {
            if($tweet->user_id == Auth::user()->id || $tweet->users->isFollowed()) {
                $followed_tweets[] = $tweet;
            }
        }
        return response()->json([ 'all_tweets' => $followed_tweets], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'tweet_body' => 'required'
        ]);
        $tweet = Tweet::create([
            'tweet_body' => $request->tweet_body,
            'user_id' => Auth::user()->id,
            'file' => $request->file ? $this->convert_base64($request->file[0]) : null,
        ]);

        return response()->json(['tweet' => $tweet], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tweet = Tweet::where('id', $id)->update([
            'tweet_body' => $request->tweet_body,
        ]);
        return response()->json(['tweet' => $tweet], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tweet = Tweet::destroy($id);

        return response()->json(['success' => $tweet], 200);
    }


    public function convert_base64($file)
    {
        $mimeType = 'data:'.$file->getMimeType();
        $base64 = base64_encode(file_get_contents($file));

        return  $mimeType . ';base64,' . $base64 ;
    }
}
