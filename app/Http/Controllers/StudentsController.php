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
            ->leftJoin('inclusive_organization', 'students.organization_id', '=', 'inclusive_organization.id')
            ->where('students.active', '1')
            ->select('students.*', 'inclusive_organization.organization_name')
            ->orderBy('students.created_at', 'DESC')
            ->get();

        $organizations = DB::table('inclusive_organization')
            ->select('*')
            ->orderBy('created_at', 'DESC')
            ->get();

        // Log::info($students_data);
        return view('dashboard', compact('students_data', 'organizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
      
        try {
            Log::info($request->all());

            // Insert the student record
            $studentId = DB::table('students')->insertGetId([
                'first_name' => $request->First_name,
                'last_name' => $request->Last_name,
                'gender' => $request->gender ,
                'birth_date' => $request->Birth_date,
                'birth_place' => $request->birth_place,
                'age' => $request->Age ?? 0,
                'massar_code' => $request->Massar_code,
                'education_level' => $request->education_level,
                'inclusive_teacher' => $request->Integrated_teacher,
                'organization_id' => $request->inclusive_organization ?? null,
                'disability_type' => $request->Disability_type,
                'disability_degree' => $request->disability_degree ?? '0',
                'companian_need' => $request->companian_need ?? 'N',
                'room_service_hours' => $request->Hours_number ?? 0,
                'cognitive_services_type' => $request->Stervices_provided_type,
                'medical_intervention' => $request->medical_intervention,
                'medical_intervention_details' => $request->Intervention_type ?? null,
                'benefits_from_adaptation' => !empty($request->benefits_from_adaptation) ? 1 : 0,
                'adaptation_type' => $request->Conditioning_type ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Update gender count in inclusive_organization table if organization is selected
            if (!empty($request->inclusive_organization)) {
                $genderField = $request->gender == 'ذكر' ? 'male_count' : 'female_count';
                
                DB::table('inclusive_organization')->where('id', $request->inclusive_organization)->increment($genderField);
            }

            // Log success
            Log::info('Student created successfully', ['student_id' => $studentId ]);

            // Redirect with success message
            session()->flash('success', 'تم إضافة الطالب(ة) بنجاح');
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
          
            // Log error
            Log::error('Error creating student', [ 'error' => $e->getMessage() , 'Error Line ' => $e->getLine(), 'Error File' => $e->getFile() ]);

            // Redirect back with error message
            session()->flash('danger', '(ة)حدث خطأ أثناء إضافة الطالب' );
            return redirect()->back();
        }
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
    public function edit($id){
        $studebt_info = DB::table("students")->Where("id", $id)->first() ;
        Log::info("testing edit function") ;
        Log::info("Student id is #". $id) ;
        return $studebt_info ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function change_status(Request $request){
        Log::info("Called change_status with data: ", $request->all());

        try{
        
          $student_id = $request->student_id;
          $new_status = $request->new_status;
          DB::table('students')->where('id', $student_id)->update(['active' => $new_status]);

          session()->flash('success', 'تم تغيير حالة التلميذ(ة) بنجاح');
          return redirect()->back();

        } catch(\Exception $e){

          Log::error('Error changing student status', [ 'error' => $e->getMessage(), 'Error Line ' => $e->getLine(), 'Error File' => $e->getFile()  ]);
         
          session()->flash('danger', '(ة)حدث خطأ أثناء تغيير حالة التلميذ' );
          return redirect()->back();
        }

    }
}
