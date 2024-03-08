<?php

namespace App\Http\Controllers;

use App\Models\UserRoles;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function insertRole(Request $request)
    {

        // dd($request->all());

        $validatedData = $request->validate([
            'role' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'access' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $role = new UserRoles();
            $role->role = $validatedData['role'];
            $role->email = $validatedData['email'];
            $role->password =  bcrypt($validatedData['password']);
            $role->access = $validatedData['access'];
            $role->isSuperAdmin = $request->super_admin ?? 0; //set default 0 if not provided

            $role->save();

            DB::commit();

            return redirect('/superadmin/createrole')->with('success', 'Successfully added role');
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            return redirect()->back()->with('error', 'Failed to add role. Please try again later.');
        }
    }

    public function updateRoleForm(Request $request, $id)
    {

        $role =  UserRoles::findOrFail($id);

        return view('superadmin.create_role', compact('role'));
    }

    public function updateRole(Request $request, $id)
    {

        // dd($request->all());

        $validatedData = $request->validate([
            'role' => 'required|string',
            'email' => 'required|string',
            'access' => 'required|string',
        ]);

        $data = [
            'role' => $validatedData['role'],
            'email' => $validatedData['email'],
            'access' => $validatedData['access'],
            'isSuperAdmin' => $request->super_admin ?? 0,
        ];


            $role = UserRoles::findOrFail($id);

            $role->update($data);

            return redirect()->route('roles_list')->with('success', 'Role updated successfully');

    }


    public function deleteRole($id)
    {

        $role =  UserRoles::findOrFail($id);

        $role->delete();

        return view('superadmin.role_list');
    }


    public function viewRoleList()
    {

        $roles = UserRoles::all();

        return view('superadmin.roles_list', compact('roles'));
    }
}
