<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\TypeUser;
use Validator;

class TypeUserController extends Controller
{
    public function getAllTypes(){

        $types_all = TypeUser::all();
        $data = [
            "status" => 1,
            "data" =>  $types_all,          
        ];
        return response()->json($data);

    }

    public function getType(Request $request){

        $validator = Validator::make($request->all(),[
           'type_id' => "required|integer|min:1|exists:type_users,id",
        ]);

        if($validator->fails()){

            $data = [
                'status' => 0,
                'errors' => $validator->errors(),
            ];

        }else{

            $type = TypeUser::find($request->input('type_id'));
            $data = [
                'status' => 1,
                'type' => $type,
            ];

        }

        return response()->json($data);
    }

    public function setType(Request $request){

        $validator = Validator::make($request->all(),[
           'type' => "required|string|min:1|alpha_num|unique:type_users,type",
        ]);

        if($validator->fails()){
            $data = [
                'status' => 0,
                'errors' => $validator->errors(),
            ];
        }else{

            $typeUser = new TypeUser();
            $typeUser->type = $request->input('type');
            $typeUser->save();

            $data = [
                'status' => 1,
            ];
        }

        return response()->json($data);

    }

    public function putType(Request $request){

        $validator = Validator::make($request->all(),[
            'type_id' => 'required|integer|min:1|exists:type_users,id',
            'type' => 'required|string|min:1|alpha_num'         
        ]);

        if($validator->fails()){
            $data = [
                'status' => 0,
                'errors' => $validator->errors(),
            ];
        }else{
            $typeUser = TypeUser::find($request->input('type_id'));
            $typeUser->type = $request->input('type');
            $typeUser->save();
            $data = [
                'status' => 1,
            ];
        }

        return response()->json($data);
    }

    public function deleteType(Request $request){

        $validator = Validator::make($request->all(),[
            'type_id' => "required|integer|min:1|exists:type_users,id",
        ]);

        if($validator->fails()){
            $data = [
                'status' => 0,
                'errors' => $validator->errors(),
            ];
        }else{
            TypeUser::destroy($request->input('type_id'));
            $data = [
                'status' => 1,
            ];
        }
        return response()->json($data);  	
    }
}
