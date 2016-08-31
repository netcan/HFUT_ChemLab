<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    function __construct() {
        if(Gate::denies('manageUser'))
            abort(403);
    }
    public function index() {
        $users = User::orderBy('type', 'asc')->orderBy('uid', 'asc')->paginate(10);
        return view('admin.usersMgr.index', [
            'users' => $users
        ]);
    }
    public function edit($id) {
        $user = User::find($id);
        return view('admin.usersMgr.edit', [
            'user' => $user
        ]);
    }
    public function update(Request $request, $id) {
        $this->validate($request, [
            'uid'=>'required|unique:users,uid,'.$id,
            'name'=>'required',
            'type'=>'required|in:0,1,2',
            'password'=>'min:6'
        ]);
        $user = User::find($id);
        if($user->id == auth()->user()->id && $user->type != $request->type)
            return redirect()->back()->withInput()->withErrors('您不能给自己取消管理员身份！');


        if($request->has('password')) $password = bcrypt($request->password);
        else $password = $user->password;
        $user->fill([
            'uid' => $request->uid,
            'name' => $request->name,
            'type' => $request->type,
            'password' => $password,
        ]);
        if($user->save())
            return redirect('admin/usersMgr');
        else
            return redirect()->back()->withInput()->withErrors('编辑失败！');
    }
}
