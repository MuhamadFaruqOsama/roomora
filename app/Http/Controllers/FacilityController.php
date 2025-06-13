<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassFacility;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FacilityController extends Controller
{
    public function deleteFacilityClassAdmin(Request $request) {
        try {
            
            $rules = [
                'id' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status_code' => 422,
                    'status' => false,
                    'message' => $validator->errors()->first()
                ]);
            }
            
            $deleteFacility = ClassFacility::find($request->id);    

            if(!$deleteFacility) {
                return response()->json([
                    'status_code' => 404,
                    'status' => false,
                    'message' => 'Facility not found'
                ]);
            }

            $deleteFacility->delete();
            
            return response()->json([
                'status_code' => 200,
                'status' => true,
                'message' => 'Facility deleted successfully'
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 500,
                'status' => false,
                'message' => 'Unexpected error occurred. Plese try again later.'
            ]);
        }
    }
}
