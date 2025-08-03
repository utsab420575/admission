<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Logout the user
    public function UserDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with([
            'message' => 'Profile Logout Successfully',
            'alert-type' => 'info',
        ]);
    }

    // Show password change form
    public function UserPasswordChange()
    {
        return view('user_profile.change_password');
    }

    // Update password
    public function UserPasswordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return redirect()->back()->with('error', 'Old Password Not Match');
        }

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('dashboard')->with('message', 'Password changed successfully.');
    }

    // Show add user form
    public function AddUser()
    {
        $roles = Role::all();
        $designations = Designation::all();
        $departments = Department::all();
        return view('users.add_user', compact('roles','designations','departments'));
    }

    // Store new user
    public function StoreUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'roles' => 'required|array',
            'roles.*' => 'string|exists:roles,name',
            'designation_id' => 'required|exists:designations,id',
            'department_id' => 'required|exists:departments,id',
        ]);

        DB::beginTransaction();

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('12345678'); // Default password
            $user->designation_id = $request->designation_id;
            $user->department_id = $request->department_id;
            $user->save();

            // Assign roles
            $user->assignRole($request->roles); // Accepts array

            DB::commit();

            return redirect()->route('user.all')->with([
                'message' => 'User created successfully',
                'alert-type' => 'success',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withInput()->with([
                'message' => 'User creation failed: ' . $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }

    // List all users
    public function AllUser()
    {
        $users = User::with('roles')->get(); // Ensures roles are available
        return view('users.all_user', compact('users'));
    }

    // Show edit form
    public function EditUser($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit_user', compact('user', 'roles'));
    }

    // Update user info
    public function UpdateUser(Request $request)
    {
        $user = User::findOrFail($request->id);

        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'roles' => 'required|array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        DB::beginTransaction();

        try {
            // Update basic info
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            // Sync roles using Spatie
            $user->syncRoles($request->roles); // accepts array of role names

            DB::commit();

            return redirect()->route('user.all')->with([
                'message' => 'User updated successfully',
                'alert-type' => 'success',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('User update failed', ['error' => $e->getMessage()]);

            return redirect()->back()->with([
                'message' => 'Something went wrong: ' . $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }
    // Delete user
    public function DeleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.all')->with([
                'message' => 'User not found.',
                'alert-type' => 'error'
            ]);
        }

        DB::beginTransaction();

        try {
            $user->delete();

            DB::commit();

            return redirect()->route('user.all')->with([
                'message' => 'Deleted successfully',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('User delete failed', ['error' => $e->getMessage()]);

            return redirect()->route('user.all')->with([
                'message' => 'Delete failed: ' . $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
    }
}
