<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update(Request $request, $id) {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'birthday'=> 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user =  User::find($id);

        $isEmail = $user->where("email", $request->email)
                        ->where("id", "!=", $user->id)
                        ->exists();

        if($isEmail){
            return ApiResponse::error("Falha ao atualizar o usuário.", ["email"=> "Tente outro e-mail"]);
        }


        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->role = $request->role ?? null;
        $user->bio = $request->bio ?? null;

        if($user->save()){
            return ApiResponse::success("Usuário atualizado", $user, 201);
        }

        return response()->json($user, 201);
    }

    public function findByUser($id){
        $user = User::find($id);

        if(!$user){
            return ApiResponse::error("Usuário não encontrado", [""], 401);
        }

        return ApiResponse::success("Usuário encontrado", [$user], 200);
    }

    public function delete($id){
        $user = User::find($id);

        if(!$user){
            return ApiResponse::error("Usuário não encontrado", [""], 401);
        }

        $user->delete();

        return ApiResponse::success("Usuário encontrado", [$user], 200);
    }
}
