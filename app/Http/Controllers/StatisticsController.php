<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Log;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        // $organization_data = DB::table('inclusive_organization')
        //     ->Where('active', '1')
        //     ->select('*', DB::raw('female_count + male_count as total_members'))
        //     ->orderBy('created_at', 'DESC')
        //     ->get();

        // Log::info($organization_data);
        return view('statistics.index'/*, compact('organization_data')*/ );
    }

    public function inclusiveOrganizations()
    {
        $data = DB::table('students')
            ->leftJoin('inclusive_organization', 'students.organization_id', 'inclusive_organization.id')
            ->where('students.active', '1')
            ->select(
                'organization_name',
                DB::raw('SUM(CASE WHEN gender = "ذكر" THEN 1 ELSE 0 END) as total_males'),
                DB::raw('SUM(CASE WHEN gender = "أنثى" THEN 1 ELSE 0 END) as total_females')
            )
            ->groupBy('organization_name')
            ->get();

        return response()->json($data);
    }

    public function disabilities_type()
    {
        $data = DB::table('students')
            ->where('active', '1')
            ->select('Disability_type', DB::raw('COUNT(*) as total'))
            ->groupBy('Disability_type')
            ->get();

        return response()->json($data);
    }
}
