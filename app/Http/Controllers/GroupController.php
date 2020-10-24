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


        $groupId = DB::table('groups')
                ->select('id')
                ->where('groups.name', '=', $request->group_name)
                ->get();

        if($groups->all() != null && $groupId != null){
            $group = $groups[0];

            $groupMemberToNotify = DB::table('users AS u')
                                        ->join('user_groups_list', 'u.id', '=', 'user_groups_list.group_list_id')
                                        ->join('groups', 'groups.id', '=', 'user_groups_list.group_id')
                                        ->select('u.id')
                                        ->where('groups.name', '=', $group->name)
                                        ->get()[0];

            $groupId = $groupId[0]->id;


            return view('search-groups',['member' => $groupMemberToNotify->id, 'group' => $request->group_name, 'groupId' => $groupId]);
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

    public function viewGroup(Request $request){

        $groupMembers = DB::table('users AS u') //view all members in group that are not the current user
                                        ->join('user_groups_list', 'u.id', '=', 'user_groups_list.group_list_id')
                                        ->join('groups', 'groups.id', '=', 'user_groups_list.group_id')
                                        ->select('u.name', 'u.id')
                                        ->where([
                                            ['groups.name', '=', $request->only(['group'])],
                                            ['u.id','!=',Auth::id()],
                                        ])->get()->all();


        return view('group-members')->with('members',$groupMembers);

    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function addToGroup(Request $request){
        //
        $userId = $request->id;
        $groupToAddTo = $request->groupToAddTo;

        $user_group = DB::table('user_groups_list')
                        ->select('group_list_id', 'group_id')
                        ->where(['group_list_id' => $userId, 'group_id' => $groupToAddTo])
                        ->get()
                        ->all();

        if($user_group == null){
            DB::table('user_groups_list')->insertOrIgnore(['group_list_id' => $userId, 'group_id' => $groupToAddTo]);
            DB::table('groups_users')->insertOrIgnore(['group_id'=> $request->groupToAddTo,'user_id' => $userId]);
        }

        return redirect('/userhome');
     }


     /**
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

     public function viewGroupMember($id){
        $user = DB::table('users')
                    ->select('name')
                    ->where(['id' => $id])
                    ->get()[0]
                    ->name;
        return view('view-group-member-products')->with('name', $user);
     }

}

?>
