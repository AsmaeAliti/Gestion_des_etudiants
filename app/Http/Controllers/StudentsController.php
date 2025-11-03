<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
      $students_data = DB::table('students')
          ->leftJoin('inclusive_organization', 'students.Inclusive_organization', '=', 'inclusive_organization.id')
          ->select('students.*', 'inclusive_organization.organization_name')
          ->orderBy('students.created_at', 'DESC')
          ->get();

      // Log::info($students_data);
      return view('dashboard', compact('students_data'));
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
