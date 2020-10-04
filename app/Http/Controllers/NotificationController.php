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

    public function sendJoinRequestNotification(){
        $userSchema = User::first();

        $joinRequest = [
            'name' => 'My Name',
            'body' => 'MY Body',
            'joinText' => 'My Text',
            'joinUrl' => url('/'),
            'joinRequest_id' => 1
        ];

        $userSchema->notify(new JoinRequest($joinRequest));

        dd('Task completed!');






    }
}
