<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function assign_admin($id)
    {
        $user = User::findOrFail($id);
        $user->assignRole('admin');
        return redirect()->route('dashboard.index')->with('success', 'successfully assigned role!');
    }
}
