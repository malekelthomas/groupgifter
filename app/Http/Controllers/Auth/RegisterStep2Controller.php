<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'group_name' => ['alpha_dash', 'max:20', 'min:10'],
        ]);
    }

    public function showForm()
    {
        return view('auth.register-step2');
    }
    public function postForm(Request $request)
    {
        auth()->user()->update($request->only(['group_name']));

        $group = DB::table('groups')->where('name', $request->only(['group_name']))->get(); //check if group name already exists

        if ($group->count() == 0){//if group does not exist, create one
            $group = new group();
            $group->name = $request->input('group_name');
            $group->save();
            auth()->user()->group_id = $group->id;

        }
        else{
            auth()->user()->group_id = $group[0]->id; //set user group_id to created/existing group_id
        }
        auth()->user()->save();
        return redirect()->route('home');
    }
}

?>
