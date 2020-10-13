<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create-groups');
    }

    /**
     * Show the form for joining a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function join()
    {
        return view('join-groups');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(['group_name' => ['required','alpha_dash', 'max:20', 'min:10', 'unique:groups,name']]);
        auth()->user()->update($request->only(['group_name']));

        $group = DB::table('groups')->where('name', $request->only(['group_name']))->get(); //check if group name already exists
        $groups_list = DB::table('user_groups_list');
        $groups_users = DB::table('groups_users');



        if ($group->count() == 0){//if group does not exist, create one
            $group = new group();
            $group->name = $request->input('group_name');
            $group->save();
            $groups_users->insert(['group_id' => $group->id, 'user_id' => auth()->user()->id]);
            $groups_list->insert(['group_list_id' => auth()->user()->id, 'group_id' => $groups_users->where('group_id', '=', $group->id)->get()[0]->group_id]);

        }

        return redirect('/userhome')->with('success', 'Group has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $groups = DB::table('groups')
            ->join('groups_users','groups.id','=','groups_users.group_id')
            ->join('user_groups_list', 'groups_users.group_id', '=','user_groups_list.group_id')
            ->select('name')
            ->where('user_groups_list.group_list_id','=',$id)
            ->get();

        return view('view-groups',['groups' => $groups]);




    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request){
        //
        $request->validate(['group_name' => ['required','alpha_dash', 'max:20', 'min:10']]);

        $groups = DB::table('groups')
            ->join('groups_users','groups.id','=','groups_users.group_id')
            ->join('user_groups_list', 'groups_users.group_id', '=','user_groups_list.group_id')
            ->select('name')
            ->where([
                ['user_groups_list.group_list_id','!=',Auth::id()], //groups current user is not in
                ['groups.name', '=', $request->only(['group_name'])], //name of group they're looking to join
                ])->get();


        if($groups->all() != null){
            $group = $groups[0];

            $groupMemberToNotify = DB::table('users AS u')
                                        ->join('user_groups_list', 'u.id', '=', 'user_groups_list.group_list_id')
                                        ->join('groups', 'groups.id', '=', 'user_groups_list.id')
                                        ->select('u.id')
                                        ->where('groups.name', '=', $group->name)
                                        ->get()[0];


            return view('search-groups',['member' => $groupMemberToNotify->id]);
        }

        else{

            echo "<script>";
            echo "console.log(alert('Already In Group/Group Does Not Exist'));";
            echo "window.location = '/group/join';";
            echo "</script>";
        }
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function view_group(Request $request){

        $groupMembers = DB::table('users AS u') //view all members in group that are not the current user
                                        ->join('user_groups_list', 'u.id', '=', 'user_groups_list.group_list_id')
                                        ->join('groups', 'groups.id', '=', 'user_groups_list.id')
                                        ->select('u.name')
                                        ->where([
                                            ['groups.name', '=', $request->only(['group'])],
                                            ['u.id','!=',Auth::id()],
                                        ])->get()->all();


        return view('group-members')->with('members',$groupMembers);

    }


}

?>
