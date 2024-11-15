<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->hasPermission('developer-dashboard')) {
            return $this->Developerdashboard();
        } elseif (Auth::user()->hasPermission('admin-dashboard')) {
            return $this->Admindashboard();
        } elseif (Auth::user()->hasPermission('manager-dashboard')) {
            return $this->Managerdashboard();
        } else {
            return $this->Defaultdashboard();
        }
    }

    public function Developerdashboard()
    {
        $total_user = User::where('role_id', 4)->count();
        $total_admin = User::whereNotIn('role_id', [1, 4])->count();
        $role = Role::query();
        $new_register_users = User::with('role:id,name')->select('id', 'role_id', 'first_name', 'last_name', 'email', 'created_at')->latest('id')->whereNot('id', 1)->limit(5)->get();

        return view('backend.pages.dashboard.developer', compact(
            'total_user',
            'total_admin',
            'role',
            'new_register_users'
        ));
    }

    public function Admindashboard()
    {
        $total_user = User::where('role_id', 4)->count();
        $new_register_users = User::with('role:id,name')->select('id', 'role_id', 'first_name', 'last_name', 'email', 'created_at')->latest('id')->whereNot('id', 1)->limit(5)->get();
        return view('backend.pages.dashboard.admin', compact(
            'total_user',
            'new_register_users',
        ));
    }

    public function Managerdashboard()
    {
        return view('backend.pages.dashboard.manager');
    }

    public function Defaultdashboard()
    {
        return view('backend.pages.dashboard.default');
    }

}
