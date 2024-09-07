<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreUpdateRequest;
use App\Traits\UploadThumbTrait;
class UserController extends Controller
{
    use UploadThumbTrait;

    public function index(){
        $user = User::all();
        return $user;
    }

    public function store(StoreUpdateRequest $request){
    
        $validatedData = $request->validated();

        if($request->hasFile('thumb')){
            $validatedData['thumb'] = $this->uploadThumbTrait($request->file('thumb'),'photos');
        }

        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);
    
        return response()->json([
            'message' => 'Usuario criado com sucesso',
            'user' => $user,
        ],201);

    }
    public function update(StoreUpdateRequest $request, string $id){

           $validatedData = $request->validated();
           $user = User::findOrFail($id);

            if($request->hasFile('thumb')){

                //Verify and delete old image users
               if(!is_null($user->thumb)){
                   $old_thumb = $user->thumb;
                    if(Storage::disk('public')->exists($old_thumb)){
                       Storage::disk('public')->delete($old_thumb);
                   }
               }
               //Chama o metodo trait que salva e retorna o path salvo no store, com nome da pasta que se deseja
               $validatedData['thumb'] = $this->uploadThumbTrait($request->file('thumb'),'photos');
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
