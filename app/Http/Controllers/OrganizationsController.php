<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;

class OrganizationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list(){
        $organization_data = DB::table('inclusive_organization')
              ->select('*', DB::raw('female_count + male_count as total_members'))
              ->orderBy('created_at', 'DESC')
              ->get();

        // Log::info($organization_data);
        return view('organizations.list', compact('organization_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
