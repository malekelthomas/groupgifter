<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\Group;
use App\Http\Controllers\Controller;



class RegisterStep2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showForm()
    {
        return view('auth.register-step2');
    }
    protected function postForm(Request $request)
    {

        $request->validate(['group_name' => ['required','alpha_dash', 'max:20', 'min:10', 'unique:groups,name']]);
        auth()->user()->update($request->only(['group_name']));

        $group = DB::table('groups')->where('name', $request->only(['group_name']))->get(); //check if group name already exists
        $pivot = DB::table('groups_users');

        if ($group->count() == 0){//if group does not exist, create one
            $group = new group();
            $group->name = $request->input('group_name');
            $group->save();
            $pivot->insert(['group_id' => $group->id, 'user_id' => auth()->user()->id]);
            auth()->user()->group_id = $pivot->where('group_id', '=', $group->id)->get()[0]->group_id;

        }
        else{
            $pivot->insert(['group_id' => $group[0]->id, 'user_id' => auth()->user()->id]);
            auth()->user()->group_id = $pivot->where('group_id', '=', $group[0]->id)->get()[0]->group_id; //set user group_id to created/existing group_id
        }
        auth()->user()->save();
        return redirect()->route('home');
    }
}

?>
