<?php

namespace App\Http\Controllers;

use App\Models\SysRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SysRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'sys_name' => ['required', 'string', 'max:255'],
            'sys_type' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $sys_requirement = SysRequirement::create([
            'name' => $request->sys_name,
            'type' => $request->sys_type,
            'user_id'=> Auth::user()->id,
        ]);

        if ($sys_requirement) {
            return back()->with('success', 'Application Requirement is Added to System.');
        }else{
            return back()->with('error', "Failed to add requirement");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SysRequirement  $sysRequirement
     * @return \Illuminate\Http\Response
     */
    public function show(SysRequirement $sysRequirement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SysRequirement  $sysRequirement
     * @return \Illuminate\Http\Response
     */
    public function edit(SysRequirement $sysRequirement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SysRequirement  $sysRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SysRequirement $sysRequirement)
    {
        $validator = Validator::make($request->all(), [
            'sys_name' => ['required', 'string', 'max:255'],
            'sys_type' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $sys_requirement = $sysRequirement->update([
            'name' => $request->sys_name,
            'type' => $request->sys_type
        ]);

        if ($sys_requirement) {
            return back()->with('success', 'Application Requirement is Updated.');
        }else{
            return back()->with('error', "Failed to Update requirement");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SysRequirement  $sysRequirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(SysRequirement $sysRequirement)
    {
        if ($sysRequirement->delete()) {
            return back()->with('success', 'Application requirement has been deleted');
        }else{
            return back()->with('error', 'Failed to delete requirement, Try Again later!');   
        }
    }
}
