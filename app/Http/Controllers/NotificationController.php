<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Notification;
use App\Notifications\JoinRequest;

class NotificationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        view('product');
    }


    /**
     * Send notification to user with id
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function sendJoinRequestNotification(Request $request){

        $userSchema = User::find($request->member);

        $joinRequest = [
            'name' => 'Maleke Thomas',
            'body' => 'Made from my groupgifter app!',
            'joinText' => 'Join Now!',
            'joinUrl' => url('/'),
            'joinRequest_id' => 1
        ];

        $userSchema->notify(new JoinRequest($joinRequest));

        return redirect('/userhome');








    }
}
