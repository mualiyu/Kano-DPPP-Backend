<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\BusinessSubCategory;
use App\Models\SysRequirement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business_category = BusinessCategory::all();

        $sys_requirements = SysRequirement::all();

        return view('settings.index', compact('business_category', 'sys_requirements'));
    }

    public function create_b_category(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'sub_name' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $b_category = BusinessCategory::create([
            'name'=> $request->name,
        ]);

        if ($b_category) {
            foreach ($request->sub_name as $s_name) {
                if (!$s_name == Null) {
                    $b_sub_c = BusinessSubCategory::create([
                        'name'=> $s_name,
                        'b_c_id' => $b_category->id,
                    ]);
                }
            }
            return redirect()->route('settings')->with("success", "New Business Category has been Added");
        }else{
            return back()->with("error", "Failed to Add Business, Try Again Later.");
        }
    }

    public function show_create_b_category()
    {
        return view("settings.business_category.create");
    }
    
    public function show_edit_b_c($id)
    {
        $business_category = BusinessCategory::find($id);

        return view("settings.business_category.edit", compact("business_category"));
    }

    public function update_b_c(Request $request, $id)
    {
        $business_category = BusinessCategory::find($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'sub_name' => ['required'],
            'sub_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $b_category = $business_category->update([
            'name'=> $request->name,
        ]);

        if ($b_category) {
            foreach ($request->sub_id as $s_id) {
                if (!$s_id == Null) {
                    $b_sub_c = BusinessSubCategory::where(['id'=>$s_id])->update([
                        'name'=> $request->sub_name[$s_id],
                    ]);
                }
            }

            if (!empty($request->sub_new_name)) {
                # code...
                if (count($request->sub_new_name) > 0) {
                    foreach ($request->sub_new_name as $s_name) {
                        if (!$s_name == Null) {
                            $b_sub_c = BusinessSubCategory::create([
                                'name'=> $s_name,
                                'b_c_id' => $business_category->id,
                            ]);
                        }
                    }
                }
            }
            return back()->with("success", "New Business Category has been Added");
        }else{
            return back()->with("error", "Failed to Add Business, Try Again Later.");
        }

        return $request->all();
    }
    

    public function delete_b_c($id)
    {
        $business_category = BusinessCategory::find($id);

        return $business_category;
    }

    public function delete_b_s_c($id)
    {
        $business_sub_category = BusinessSubCategory::find($id);

        $business_sub_category->delete();

        return back()->with("success", "One Sub-Business Category is Deleted.");
    }


    public function show_admins()
    {
        $users = User::all();

        return view('settings.users.index', compact('users'));
    }

    public function register_admin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string','unique:users'],
            'role' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'image' => url('/storage/admin/default.png'),
            'password' => Hash::make($request['password']),
            'role' => $request['role'],
        ]);

        User::where('id', '=', $user->id)->update([
            'image' => url('/storage/admin/default.png'),
            'role' => $request['role'],
        ]);

        if ($user) {
            return back()->with('success', "New user is created");
        }else{
            return back()->with('error', "Failed to Register new User");
        }

        abort(500);

    }
}
