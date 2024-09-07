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
            'email' =>['required','email','unique:users,email'],
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

    public function update(Request $request, string $id){

            $validate = Validator::make($request->all(), [
                'name' => ['required', 'max:255'],
                'email' => ['required','email','unique:users,email,'.$id],
                'bio' => ['nullable'],
                'thumb' => ['nullable', 'mimes:jpeg,jpg,png','max:2048'],
                'type' => ['required', 'in:mentor,mentee'],
           ]);

            if($validate->fails()){
                return $validate->errors();
            }

           $validatedData = $validate->validated();
           $user = User::findOrFail($id);

            if($request->hasFile('thumb')){

                //Verify and delete old image users
               if(!is_null($user->thumb)){
                   $old_thumb = $user->thumb;
                    if(Storage::disk('public')->exists($old_thumb)){
                       Storage::disk('public')->delete($old_thumb);
                   }
               }
                $thumb = $request->file('thumb');
               $thumb_name = time().'-mentoria-'.$thumb->getClientOriginalName();
               $validatedData['thumb'] = $thumb->storeAs('photos', $thumb_name,'public');
           }
            $user = $user->update($validatedData);

            return response()->json([
                'message' => 'Dados do usuario atualizado com sucesso!',
                'user' => $user,
            ], 201);
    }
    
    public function show(string $id){
        $user = User::findOrFail($id);
        return response()->json([
            'message' => 'Usuario encontrado!',
            'user' => $user,
        ],201);
    }

    public function destroy(string $id){
        $user =  User::findOrFail($id);
        $deleted = $user->delete();

        return response()->json([
            'message' => 'Usuario deletado com sucesso!',
            'user' => $deleted,
        ],201);
    }
}
