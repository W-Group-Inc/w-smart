<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Permissions;
use App\User;
use App\Roles;
use App\Features;
use App\Subfeatures;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        // try {
        // $permissions = Permissions::all();

        // return response()->json([
        //     'status' => 'success',
        //     'data' => $permissions,
        // ], 200);
	    // } catch (\Exception $e) {
	    //     return response()->json([
	    //         'status' => 'error',
	    //         'message' => 'Failed to fetch permissions.',
	    //         'error' => $e->getMessage(),
	    //     ], 500); 
	    // }

        $roles = Roles::with('permission','permission.feature')->get();
        $features = Features::get();
        $employees = User::whereNull('status')->get();

        return view('settings_role', compact('roles','features','employees'));
    }

    public function storeRole(Request $request)
    {
        $role = new Roles();
        $role->role = $request->role;
        $role->save();

        foreach($request->permission as $key=>$permission)
        {
            $role_permission = new Permissions();
            $role_permission->roleid = $role->id;
            $role_permission->role = $role->role;
            $role_permission->featureid = $permission;
            $role_permission->save();
        }

        Alert::success('Successfully Saved')->persistent('Dismiss');
        return back();
    }

    public function updateRole(Request $request,$id)
    {
        // dd($request->all());
        $role = Roles::findOrFail($id);
        $role->role = $request->role;
        $role->save();

        $permission = Permissions::where('roleid', $id)->delete();
        foreach($request->permission as $key=>$permission)
        {
            $role_permission = new Permissions();
            $role_permission->roleid = $role->id;
            $role_permission->role = $role->role;
            $role_permission->featureid = $permission;
            $role_permission->save();
        }

        Alert::success('Successfully Saved')->persistent('Dismiss');
        return back();
    }

    public function deactivateRole(Request $request,$id)
    {
        // dd($request->all());
        $role = Roles::findOrFail($id);
        $role->status = 'Inactive';
        $role->save();

        Alert::success('Successfully Deactivated')->persistent('Dismiss');
        return back();
    }

    public function activateRole(Request $request,$id)
    {
        // dd($request->all());
        $role = Roles::findOrFail($id);
        $role->status = null;
        $role->save();

        Alert::success('Successfully Activated')->persistent('Dismiss');
        return back();
    }


    // public function getFeatures(Request $request)
    // {
    //     try {
    //         $subfeatures = Subfeatures::with('feature')->get();

    //         $featuresGrouped = $subfeatures->groupBy('feature.id')->map(function ($subfeatureGroup) {
    //             $feature = $subfeatureGroup->first()->feature;
    //             return [
    //                 'id' => $feature->id,
    //                 'feature' => $feature->feature,
    //                 'subfeatures' => $subfeatureGroup->map(function ($subfeature) {
    //                     return [
    //                         'id' => $subfeature->id,
    //                         'subfeature_name' => $subfeature->subfeature_name,
    //                     ];
    //                 }),
    //             ];
    //         });

    //         return response()->json([
    //             'status' => 'success',
    //             'data' => $featuresGrouped->values(),
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to fetch features and subfeatures.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
    // public function getRoles(Request $request)
    // {
    //     try {
	//         $roles = Roles::all();

	//         return response()->json([
	//             'status' => 'success',
	//             'data' => $roles,
	//         ], 200);
	//     } catch (\Exception $e) {
	//         return response()->json([
	//             'status' => 'error',
	//             'message' => 'Failed to fetch permissions.',
	//             'error' => $e->getMessage(),
	//         ], 500); 
	//     }
    // }
    // public function createRole(Request $request)
    // {
    //     try {
    //         // Validate the incoming request data
    //         $request->validate([
    //             'role' => 'required|string|max:255',
    //         ]);

    //         // Create a new role
    //         $new_role = new Roles();
    //         $new_role->role = $request->role; 
    //         $new_role->save();

    //         return response()->json([
    //             'status' => 'success',
    //             'data' => $new_role,
    //         ], 200);
    //     } catch (\Exception $e) {
    //         Log::error('Failed to create role: ' . $e->getMessage());
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to create role.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
    // public function createPermission(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'roleid' => 'required|integer',
    //             'role' => 'required|string|max:100',
    //             'featureid' => 'required|integer',
    //             'feature' => 'required|string|max:100',
    //             'subfeature_id' => 'nullable|integer',
    //         ]);

    //         $featureName = $request->feature;

    //         if ($request->subfeature_id) {
    //             $subfeature = Subfeatures::find($request->subfeature_id);
    //             if ($subfeature) {
    //                 $featureName = $subfeature->subfeature_name;
    //             }
    //         }

    //         $new_permission = new Permissions();
    //         $new_permission->roleid = $request->roleid;
    //         $new_permission->role = $request->role;
    //         $new_permission->featureid = $request->featureid;
    //         $new_permission->feature = $featureName;
    //         $new_permission->subfeature_id = $request->subfeature_id;
    //         $new_permission->save();

    //         return response()->json([
    //             'status' => 'success',
    //             'data' => $new_permission,
    //         ], 200);
    //     } catch (\Exception $e) {
    //         Log::error('Failed to create permission: ' . $e->getMessage());
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to create permission.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
    // public function delete(Request $request)
    // {
    //     try {
    //         $role = Roles::find($request->id);

    //         if (!$role) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'Role not found.',
    //             ], 404);
    //         }

    //         $usersWithRole = User::where('role', $role->id)->count();

    //         if ($usersWithRole > 0) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'There are still users assigned to this role. Transfer users before deleting.',
    //             ], 400);
    //         }

    //         $permissions = Permissions::where('roleid', $role->id)->get();

    //         foreach ($permissions as $permission) {
    //             $permission->delete();
    //         }

    //         $role->delete();

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Role and associated permissions deleted successfully',
    //         ], 200);

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to delete role and associated permissions.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

}
