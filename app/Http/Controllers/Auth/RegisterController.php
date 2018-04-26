<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Role;
use Image;
use Storage;
use App\Http\Requests\RegistrationForm;

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
    protected $redirectTo = '/register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function showRegistrationForm()
    {  

       $roles = Role::all();
        return view('Auth.register',compact('roles'));
    }

    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function register(Request $request )
    {   


        $validator = Validator::make($request->all(),[

            
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'middlename' => 'string|max:255',
            'username' => 'required|string|max:10|min:10|unique:users',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',

        ]);
        


        if ($validator->passes()) 
        {

             $user = new User();

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->middlename = $request->middlename;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role_id = $request->userrole;
            $user->status = 1;
            $user->save();

        if( !empty( $request->file('avatar') ) ){

            $path = $this->uploadAvatar($user->id, $request->file('avatar'));

            $user->avatar =  $path;
            $user->update();

        }else{

            $user->avatar = '/storage/users/default.jpg';
            $user->update();
        }

       

        $users = User::all();

        return view('admin.users',compact( 'users' ))->with('message', 'SUCCESSFULY REGISTERED NEW USER.');

        }
        else
        {
            $users = User::all();
            return back()->with(compact( 'users' ))->withErrors( $validator->messages())->withInput();
        }




    }  







     public function uploadAvatar($id, $data){


        //generating unique file name;
        $file_name = 'photo_'.time().'.png';
        $file_name_thumb = 'thumb_'.time().'.png';

        $destinationPath = '/public/users/'.$id.'/';

        if( Storage::exists( $destinationPath ) ) Storage::deleteDirectory( $destinationPath );

        $image = Image::make( $data->getRealPath()  )->resize(400, 400);

        Storage::disk('local')->put( $destinationPath . $file_name,  $image->stream());


        return'/storage/users/'.$id.'/' .$file_name;

    }






}
        