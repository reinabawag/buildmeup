<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Department;
use App\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountStatus;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $departments = Department::all();

        return view('admin.index')->with(['users' => $users, 'departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::all();
        $departments = Department::all();        

        $roles_array = [];
        foreach ($roles as $key => $role) {
            array_push($roles_array, ['id' => $role->id, 'status' => $user->hasAnyRole($role->type), 'type' => $role->type]);
        }

        return view('admin.show')->with(['user' => $user, 'departments' => $departments, 'roles' => $roles_array]);
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
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'department_id' => 'required'
        ]);

        $user->status = $request->status;

        $user->department()->associate(Department::find($request->department_id));
        $user->roles()->sync($request->role); 
        $user->save();

        // Mail::to($user->email)->send(new AccountStatus($user));

        return redirect()->back()->withStatus('User status updated successfully!');
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
}
