<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Group;
use App\Http\Controllers\Controller;

class RegisterStep2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showForm()
    {
        return view('auth.register-step2');
    }
    public function postForm(Request $request)
    {
        auth()->user()->update($request->only(['group_name']));
        return redirect()->route('home');
    }
}

?>