<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Arr;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserCollection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'email' => 'Atribut :attribute tidak valid.',
            'min' => 'Atribut :attribute minimal 6 karakter!'
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       
        
        $isDataExist = User::where('email','=',$request->email)->first();
        if($isDataExist) return $this->sendError('Gagal menyimpan karena data '. $isDataExist->email .' sudah tersimpan !');
        
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return $this->sendResponse([
            'user' => [new UserResource($user)]
        ], 'Berhasil menyimpan data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if($user) return $this->sendResponse([
            'user' => [new UserResource($user)]
        ], 'success');
        return $this->sendError('Data tidak ditemukan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $messages = [
            'required' => 'Atribut :attribute tidak boleh kosong.',
            'email' => 'Atribut :attribute tidak valid.',
            'min' => 'Atribut :attribute minimal 6 karakter!'
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
            'new_password' => 'required|min:6'
        ],$messages);
   
        if($validator->fails()) return $this->sendError('Validasi data gagal.', Arr::first(Arr::flatten($validator->messages()->get('*'))));       

        $user = User::where('email','=', $request->email)->first();
        if(!$user) return $this->sendError('Data tidak ditemukan!');
        
        $credentials = $request->only(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) return $this->sendError('Password salah!');

        $user->update([
            'email' => $request->email,
            'password' => bcrypt($request->new_password)
        ]);
        return $this->sendResponse([
            'user' => [new UserResource($user)]
        ], 'Berhasil memperbaharui data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->sendResponse(null, 'Berhasil menghapus data!');
    }
}
