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
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender ,
                'birth_date' => $request->birth_date,
                'birth_place' => $request->birth_place,
                'age' => $request->age ?? 0,
                'massar_code' => $request->massar_code,
                'education_level' => $request->education_level,
                'inclusive_teacher' => $request->inclusive_teacher,
                'organization_id' => $request->inclusive_organization ?? null,
                'disability_type' => $request->disability_type,
                'disability_degree' => $request->disability_degree ?? '0',
                'companian_need' => $request->companian_need ?? 'N',
                'room_service_hours' => $request->room_service_hours ?? 0,
                'services_provided_type' => $request->services_provided_type,
                'medical_intervention' => $request->medical_intervention,
                'medical_intervention_details' => $request->medical_intervention_details ?? null,
                'benefits_from_adaptation' => !empty($request->benefits_from_adaptation) ? 1 : 0,
                'adaptation_type' => $request->adaptation_type ?? null,
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
    public function view_student($id)
    {
        //
        $student = DB::table("students")->Where("id", $id)->first() ;

        return view('student.view', compact('student'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        
        $student_info = DB::table("students")->Where("id", $id)->first() ;
        return $student_info ;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){

        Log::info("update info of the id #". $id) ;

        try{

            $student = DB::table('students')->where('id', $id)->first();
            
            if (!$student) {
                return response()->json(['status' => false, 'message' => 'لم يتم العثور على الطالب المحدد' ]);
            }

            $student_full_name = $student->first_name . " ". $student->last_name ; 
           
            // $organisaion_name
            $new_data = $request->except('_token', 's_id', 'inclusive_organization') ;
            $new_data['organization_id'] = $request->inclusive_organization ;
            
            $update_student = DB::table('students')->where('id', $id)->update($new_data);

            if ($update_student){
                return response()->json(['status' => true, 'message' => 'تم تحديث بيانات الطالب(ة): ' . $student_full_name . ' بنجاح' ]);
            } 


            return response()->json([ 'status' => false, 'message' => 'لم يتم تعديل أي بيانات']);

        } catch (\Exception $e) {
          
            // Log error
            Log::error('Error updating student', [ 'error' => $e->getMessage() , 'Error Line ' => $e->getLine(), 'Error File' => $e->getFile() ]);

            return response()->json([ 'status' => false, 'message' => '(ة)حدث خطأ أثناء تحديث بيانات الطالب']);
        }
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
