<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mahasiswa;
use App\Dosen;
use App\StaffTataUsaha;
use App\Http\Controllers\API\BaseController as BaseController;
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

        return $this->respondWithToken($token);
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
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));
        $user = User::where('email',$request->email)->first();
        $mahasiswa = Mahasiswa::where('id_user',$user->id)->first();
        if($mahasiswa==null){
            $dosen = Dosen::where('id_user',$user->id)->first();
            if($dosen==null){
                $staffTU = StaffTataUsaha::where('id_user',$user->id)->first();
                if($staffTU == null){
                    $this->sendError('Email tidak terdaftar sebagai role apapun!');
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
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 * 24 * 5
        ]);
    }
}
