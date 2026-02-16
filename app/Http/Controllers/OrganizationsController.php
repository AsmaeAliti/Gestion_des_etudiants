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
            ->Where('active', '1')
            ->select('*', DB::raw('female_count + male_count as total_members'))
            ->orderBy('created_at', 'DESC')
            ->get();

        // Log::info($organization_data);
        return view('organizations.list', compact('organization_data'));
    }

     public function store(Request $request) {
      
        try {
            
            Log::info($request->all());

            // Insert the student record
            $organizationId = DB::table('inclusive_organization')->insertGetId([
                'organization_name' => $request->organization_name,
                'female_count'=> '0',
                'male_count'=> '0',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Log success
            Log::info('Organization created successfully', ['organization_id' => $organizationId ]);

            // Redirect with success message
            session()->flash('success', 'تم إضافة الرافد بنجاح');
            return redirect()->route('organization.list');

        } catch (\Exception $e) {
          
            // Log error
            Log::error('Error creating organization', [ 'error' => $e->getMessage() , 'Error Line ' => $e->getLine(), 'Error File' => $e->getFile() ]);

            // Redirect back with error message
            session()->flash('danger', 'حدث خطأ أثناء إضافة الرافد ' );
            return redirect()->back();
        }
    }

    // get the users deatils basedon the orgaization 
    public function students_details($id) {

        $students_list = DB::table("students")
            ->Where("organization_id", $id)
            ->Where("active", '1')
            ->select("massar_code", "first_name", "last_name")
            ->get() ;

        Log::info($students_list) ;

        return $students_list; 
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){

        Log::info("update info of the organization id #". $id) ;

        try{
            $organization = DB::table('inclusive_organization')->where('id', $id)->first();
            
            if (!$organization) {
                return response()->json(['status' => false, 'message' => 'لم يتم العثور على الرافد المحدد' ]);
            }

            $organization_name = $organization->organization_name ; 
           
            // $organisaion_name
            $new_data = $request->except('_token', 'o_id') ;
            $update_organization = DB::table('inclusive_organization')->where('id', $id)->update($new_data);

            if ($update_organization){
                return response()->json(['status' => true, 'message' => 'تم تحديث بيانات الرافد: ' . $organization_name . ' بنجاح' ]);
            } 


            return response()->json([ 'status' => false, 'message' => 'لم يتم تعديل أي بيانات']);
        } catch (\Exception $e) {
          
            // Log error
            Log::error('Error updating organization', [ 'error' => $e->getMessage() , 'Error Line ' => $e->getLine(), 'Error File' => $e->getFile() ]);
            return response()->json([ 'status' => false, 'message' => ' حدث خطأ أثناء تحديث بيانات الرافد']);
        }
    }

    public function change_status(Request $request){

        Log::info("Called change_status organization with data: ", $request->all());

        try{
        
            $organization_id = $request->organization_id;
            $new_status = $request->new_status;
            
            // deactiavte the organization status  
            DB::table('inclusive_organization')->where('id', $organization_id)->update(['active' => $new_status]);
            
            // deactivate all the student with the affected organization 
            DB::table('students')->where('organization_id', $organization_id)->update(['active' => $new_status]);

            session()->flash('success', 'تم تغيير حالة الرافد  بنجاح');
            return redirect()->back();

        } catch(\Exception $e){

            Log::error('Error changing organization status', [ 'error' => $e->getMessage(), 'Error Line ' => $e->getLine(), 'Error File' => $e->getFile()  ]);
            
            session()->flash('danger', ' حدث خطأ أثناء تغيير حالة الرافد ' );
            return redirect()->back();
        }

    }
}
