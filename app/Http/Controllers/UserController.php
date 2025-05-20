<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $listRole = Role::all();

        return view('system-setting.users.index', compact(
            'listRole',
        ));
    }

    public function getAjax(Request $request)
    {
        if ($request->ajax()) {

            //CURRENT USER
            $cUser = Auth::User() ? Auth::User() : abort(403);

            $ddRole = $request->ddRole;

            $query =
                User::query()
                    ->join('model_has_roles', 'model_has_roles.model_id', 'users.id')
                    ->join('roles', 'roles.id', 'model_has_roles.role_id')
                    ->select(
                        'users.id AS id',
                        'roles.name AS role',
                        'users.name',
                        'users.email',
                        'users.is_active'
                    );

            if ($ddRole != '') {
                $query = $query->where('roles.id', $ddRole);
            }

            $query = $query->orderBy('roles.name', 'ASC');

            $data = !empty($query) ? $query->get() : [];

            foreach ($data as $row) {
                $row->actionUpdate = route('users.edit', ['user' => Crypt::encrypt($row->id)]);
                $row->actionDelete = route('users.destroy', ['user' => Crypt::encrypt($row->id)]);
            }

            return DataTables::of($data)->addIndexColumn()->toJson();
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        $role = $validated['role'];
        $name = strtoupper(trim($validated['name']));
        $email = strtolower($validated['email']);

        dd($role, $name, $email);
    }

    public function destroy($id)
    {
        $id = Crypt::decrypt($id);

        User::query()
            ->where('id', $id)
            ->update([
                'is_active' => 0,
                'updated_at' => now(),
            ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User deactivated successfully.',
        ]);

    }

}
