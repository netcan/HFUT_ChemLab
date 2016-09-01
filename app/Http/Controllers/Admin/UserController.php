<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function index() {
        if(Gate::denies('manageUser'))
            abort(403);

        $users = User::orderBy('type', 'asc')->orderBy('uid', 'asc')->paginate(10);
        return view('admin.usersMgr.index', [
            'users' => $users
        ]);
    }
    public function edit($id) {
        if(Gate::denies('manageUser'))
            abort(403);

        $user = User::find($id);
        return view('admin.usersMgr.edit', [
            'user' => $user
        ]);
    }
    public function update(Request $request, $id) {
        if(Gate::denies('manageUser'))
            abort(403);

        $this->validate($request, [
            'uid'=>'required|integer|unique:users,uid,'.$id,
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

    public function destroy($id) {
        if(Gate::denies('manageUser'))
            abort(403);

        $user = User::find($id);
        if($user->id == auth()->user()->id)
            return redirect()->back()->withErrors('您不能删除自己！');
        else $user->delete();
        return redirect()->back();
    }

    public function create() {
        if(Gate::denies('manageUser'))
            abort(403);

        return view('admin.usersMgr.create');
    }

    public function store(Request $request) {
        if(Gate::denies('manageUser'))
            abort(403);

        $this->validate($request, [
            'uid'=>'required|integer|unique:users,uid,',
            'name'=>'required',
            'type'=>'required|in:0,1,2',
            'password'=>'required|confirmed|min:6'
        ]);
        if(User::create([
            'uid' => $request->uid,
            'name' => $request->name,
            'type' => $request->type,
            'password' => bcrypt($request->password),
        ]))
            return redirect('admin/usersMgr');
        else
            return redirect()->back()->withInput()->withErrors('新建失败！');
    }

    public function changePwd($id) {
        if($id != auth()->user()->id)
            abort(403);
        $user = User::find($id);
        return view('user.changePwd', [
            'user' => $user
        ]);
    }
    public function updatePwd(Request $request, $id) {
        if($id != auth()->user()->id)
            abort(403);
        $this->validate($request, [
            'password'=>'required|confirmed|min:6'
        ]);
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        if($user->save())
            return redirect('/');
        else
            return redirect()->back()->withInput()->withErrors('修改失败！');
    }
}
