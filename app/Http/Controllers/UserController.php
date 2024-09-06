<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index(){
        $user = User::all();
        return $user;
    }

    public function store(Request $request){

        $validate = Validator::make($request->all(),[
            'name' => ['required', 'max:255'],
            'email' =>['required', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'bio' => ['nullable'],
            'thumb' => ['nullable','max:2048', 'image', 'mimes:png,jpg,jpeg'],
            'type' => ['required', 'in:mentor,mentee'],
        ]);
        if($validate->fails()){
            return $validate->errors();
        }
        $validated = $validate->validated();
        if($request->hasFile('thumb')){
            $thumb = $request->file('thumb');
            $thumb_name = time().'-mentoria-'.$thumb->getClientOriginalName();
            $validated['thumb'] = $thumb->storeAs('photos',$thumb_name,'public');
        }
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        return response()->json([
            'massage' => 'Usuario criado com sucesso',
            'user' => $user,
        ],201);

    }

}
