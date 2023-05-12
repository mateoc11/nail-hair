<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\models\Post;
use App\models\Rating;
use Auth;
use Image;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required','string','max:50','unique:users'],
            'cel' => ['required','string','max:50','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'foto' => ['image','nullable','max:3000'],
            'cedula' => ['mimes:pdf,jpg,png,doc','nullable','max:1999'],
            'tipo' => ['required','string','max:15','in:trabajador,cliente,admin'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if(request()->hasFile('foto')){
            $avatar = request()->file('foto');
            $filename = time(). '.'. $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save( public_path('/uploads/avatars/'.$filename));
        }else{
            $filename='default.jpg';
        }

        if(request()->hasFile('cedula')){
            $document = request()->file('cedula');
            $filenamed = time(). '.'. $document->getClientOriginalExtension();
            $filePath = public_path() . '/uploads/documents/';
            $document->move($filePath, $filenamed);
        }else{
            $filenamed=NULL;
        }

        if($data['tipo'] == 'trabajador'){
            $active='pending';
        }else{
            $active='yes';
        }

        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'cel'=> $data['cel'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tipo' => $data['tipo'],
            'active' => $active,
            'avatar' => $filename,
            'cedula' => $filenamed,
        ]);
    }
}
