<?php

namespace App\Http\Controllers;

use App\Models\Doa;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DoaController extends Controller
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
        $department = Organization::distinct()->get(['org_code','org_name']);
        $position = Organization::all('position_title','position_code','org_code','org_name');
        $user = User::all('id','name','posname','poscode','department','department_code');
        return Inertia::render('DOA/DOACreate',[
            'users' => $user,
            'department' => $department,
            'position' => $position
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function show(Doa $doa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function edit(Doa $doa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doa $doa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doa  $doa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doa $doa)
    {
        //
    }
}
