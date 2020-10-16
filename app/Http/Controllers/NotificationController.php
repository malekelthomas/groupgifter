<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Notification;
use App\Notifications\JoinRequest;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

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


        session(['groupToJoin' => $request->group]);

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


    /**
     * Send notification to user with id
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */

     public function show(Request $request){

        $notificationIdFromRequest = $request->notification;
        $name = null;
        $groupToJoin = null;



        foreach (Auth::user()->unreadNotifications->all() as $notification){

            if ($notification->id == $notificationIdFromRequest){
                $notification->markAsRead();
                $name = $notification->data["from"];
                $groupToJoin = $notification->data["toGroup"];
            }

        }

        //$notification->markAsRead();

        //$notificationFrom = $notification["from"];


        $data = [

            'name' => $name,
            'groupToJoin' => $groupToJoin,

        ];

        return view('request-notification')->with($data);




    }


}
