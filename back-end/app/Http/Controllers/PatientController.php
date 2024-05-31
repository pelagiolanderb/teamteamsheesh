<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Patient;

class PatientController extends Controller
{
    public function index() {
        $patientList = Patient::all();

        $data = [
            'status' => 200,
            'data' => $patientList
        ];

        return response()->json($data);
    }

    public function store(Request $request) {
        $rules = [
            'patientId' => 'required|numeric',
            'patientName' => 'required',
            'emailAddress' => 'required|email:rfc,dns',
            'ages' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $data = [
                'status'=>400,
                'errors'=>$validator->messages()
            ];

            return response()->json($data);
        }

        $newPatient = new Patient();

        $newPatient->patientId = $request->patientId;
        $newPatient->patientName = $request->patientName;
        $newPatient->emailAddress = $request->emailAddress;
        $newPatient->ages = $request->ages;

        $newPatient->save();

        $data = [
            'status'=>201,
            'message'=>'New patient has been successfully added.'
        ];

        return response()->json($data);
    }

    public function update(Request $request, $id) {
        $rules = [
            'patientId' => 'required|numeric',
            'patientName' => 'required',
            'emailAddress' => 'required|email:rfc,dns',
            'ages' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $data = [
                'status'=>400,
                'errors'=>$validator->messages()
            ];

            return response()->json($data);
        }

        $updatePatient = Patient::findorfail($id);

        $updatePatient->patientId = $request->patientId;
        $updatePatient->patientName = $request->patientName;
        $updatePatient->emailAddress = $request->emailAddress;
        $updatePatient->ages = $request->ages;

        $updatePatient->save();

        $data = [
            'status'=>200,
            'message'=>'Patient credentials has been successfully updated.'
        ];

        return response()->json($data);
    }

    public function delete($id) {
        $deletePatient = Patient::findorfail($id);

        $deletePatient->delete();

        $data = [
            'status'=>200,
            'message'=>'Patient credentials has been successfully deleted.'
        ];

        return response()->json($data);
    }
}
