<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surf_Users;

class UserController extends Controller
{
    public function updateUserRole(Request $request, $id)
    {
        $user = Surf_Users::findOrFail($id);
        $user->Role = $request->input('Role');
        $user->save();

        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = Surf_Users::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
