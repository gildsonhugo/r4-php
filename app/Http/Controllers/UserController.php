<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id' => ['nullable', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id'],
            'password' => ['required_without:id', 'nullable', 'string', 'min:8', 'confirmed'],
            'photo' => ['nullable', 'file']
        ]);
    }

    /**
     * Update a user instance after a valid registration.
     *
     * @param  Request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateUser(Request $request){

        $data = $request->all();

        $valid = $this->validator($data);
        if($valid->fails()){
            return redirect('profile')->withInput()->withErrors($valid);
        }

        $user = Auth::user();

        if(isset($data['photo'])){
            $ext = $data['photo']->getClientOriginalExtension();
            $photo = uniqid(date('HisYmd')).'.'.$ext;
            $data['photo']->storeAs('public', $photo);
            $user->photo = $photo;
        }

        if(isset($data['password'])){
            $user->password = Hash::make($data['password']);
        }

        $user->name = $data['name'];
        $user->email = $data['email'];

        $user->save();

        return redirect('home');
    }
}
