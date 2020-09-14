<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mahasiswa;
use App\Dosen;
use App\StaffTataUsaha;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Auth as AuthResource;
use Validator;
use Illuminate\Support\Arr;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $token = auth()->login($user);

        return $this->sendResponse([
            'auth' => new AuthResource($token)
        ], 'success');
    }

    public function login(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'email' => 'Atribut :attribute harus berupa email valid.',
            'exists' => 'Atribut :attribute tidak terdapat di database.'
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:App\User,email',
            'password' => 'required'

        ],$messages);
   
        if($validator->fails()) return $this->sendError('', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        $user = User::where('email',$request->email)->first();
        $mahasiswa = Mahasiswa::where('id_user',$user->id)->first();
        if($mahasiswa==null){
            $dosen = Dosen::where('id_user',$user->id)->first();
            if($dosen==null){
                $staffTU = StaffTataUsaha::where('id_user',$user->id)->first();
                if($staffTU == null){
                    return $this->sendError('Email tidak terdaftar!');
                } else {
                    $claims = [
                        'role' => 'Staff Tata Usaha',
                        'id_user' => $staffTU->id_user, 
                        'nama_staff' => $staffTU->nama_staff,
                        'kd_staff' => $staffTU->kd_staff,
                        'email' => $user->email
                    ];
                }
            } else {
                $claims = [
                    'role' => 'Dosen',
                    'id_user' => $dosen->id_user, 
                    'nama_dosen' => $dosen->nama_dosen,
                    'kd_dosen' => $dosen->kd_dosen,
                    'email' => $user->email                
                ];
            }
        } else {
            $claims = [
                'role' => 'Mahasiswa',
                'id_user' => $mahasiswa->id_user, 
                'nama_mahasiswa' => $mahasiswa->nama_mahasiswa,
                'nim' => $mahasiswa->nim,
                'email' => $user->email            
            ];
        }

        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->claims($claims)->attempt($credentials)) {
            return $this->sendError('Email atau password salah!','',401);
        }

        return $this->sendResponse([
            'auth' => new AuthResource($token)
        ], 'success');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return $this->sendResponse(null,'Successfully logged out');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->sendResponse([
            'auth' => new AuthResource(auth()->refresh())
        ], 'success');
    }
}
