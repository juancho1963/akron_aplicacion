<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(StoreUserRequest $request) {
        if($request->validated()){
            User::create($request->validated());
            return response()->json([
                'message' => 'Su cuenta ha sido creada exitosamente.'
            ]);
        }
    }

    public function auth(AuthUserRequest $request) {
        if($request->validated()){
            $user = User::whereEmail($request->email)->first();
            if(!$user || !Hash::check($request->password, $user->password)){
                return response()->json([
                    'error' => 'Estas credenciales no coinciden con nuestros registros.'
                ]);
            }else {
                return response()->json([
                    'user' => UserResource::make($user),
                    'access_token' => $user->createToken('new_user')->plainTextToken,
                    'message' => 'Bienvenido a Aplicacion AKRON'
                ]);
            }
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'La sesión fue cerrada con exito.'
        ]);
    }

    public function updateUserProfile(Request $request) {
        $request->validate([
            'profile_image' => 'image|mimes:png,jpg,jpeg|max:2048'
        ],[
            'profile_image.image' => 'El archivo seleccionado debe ser una imagen válida.',
            'profile_image.mimes' => 'La imagen debe ser de tipo PNG, JPG o JPEG.',
            'profile_image.max' => 'La imagen no debe superar los 2MB.',
        ]);

        if($request->has('profile_image')){
            if(File::exists(asset($request->user()->profile_image))){
                File::delete(asset($request->user()->profile_image));
            }

            $file = $request->file('profile_image');
            $profile_image_name = time().'_'.$file->getClientOriginalName();
            $file->storeAs('images/users/', $profile_image_name, 'public');

            $request->user()->update([
                'profile_image' => 'storage/images/users/'.$profile_image_name
            ]);

            return response()->json([
                'message' => 'La foto de perfil se actualizo correctamente.',
                'user' => UserResource::make($request->user())
                ]);

        } else {
            $request->user()->update([
            'direcUser' => $request ->direcUser,
            'zPostalUser' => $request ->zPostalUser,
            'docIdenUser' => $request ->docIdenUser,
            'numTelefoUser' => $request ->numTelefoUser,
            'datoCompleUser' => 1,
            ]);

            return response()->json([
                'message' => 'La informacion del perfil se actualizo correctamente.',
                'user' => UserResource::make($request->user())
            ]);
        }
    }
}

