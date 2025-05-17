<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('system-setting.users.index');
    }

    public function getAjax(Request $request)
    {
        if ($request->ajax()) {

            //CURRENT USER
            $cUser = Auth::User() ? Auth::User() : abort(403);

            $role = $request->role;

            $query =
                User::query()
                    ->join('model_has_roles', 'model_has_roles.model_id', 'users.id')
                    ->join('roles', 'roles.id', 'model_has_roles.role_id')
                    ->select(
                        'users.id AS id',
                        'roles.name AS role',
                        'users.name',
                        'users.email1',
                        'users.is_active'
                    );

            if ($role != '') {
                $query = $query->where('roles.id', $role);
            }

            $query = $query->orderBy('roles.name', 'ASC');

            $data = !empty($query) ? $query->get() : [];

//            foreach ($data as $row) {
//                $row->actionUpdate = route('users.edit', ['users' => Crypt::encrypt($row->id)]);
//                $row->actionDelete = route('users.destroy', ['users' => Crypt::encrypt($row->id)]);
//            }

            return DataTables::of($data)->addIndexColumn()->toJson();
        }
    }

}
