<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;
use App\Role;

class RegistrationForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'username' => 'required|string|max:10|min:10|unique:users',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            
            ];

    }



    public function persist(){

        $user = new User();


        $user->firstname = $this->get('firstname');
        $user->lastname = $this->get('lastname');
        $user->middlename = $this->get('middlename');
        $user->username = $this->get('username');
        $user->email = $this->get('email');
        $user->password = bcrypt($this->get('password'));
        $user->role_id = $this->get('userrole');
        $user->status = 1;
        $user->save();

        if( !empty( $this->get('avatar') ) ){

            $path = $this->uploadAvatar($user->id);

            $user->avatar = $path;

        }else{

            $user->avatar = '/storage/users/default.jpg';
        }



        $user->update();

    }





    public function uploadAvatar($id){

        $data = $this->get('avatar');



        //generating unique file name;
        $file_name = 'photo_'.time().'.png';
        @list($type, $data) = explode(';', $data);
        @list(, $data)      = explode(',', $data);


        $destinationPath = '/public/users/'.$id.'/';

        if( Storage::exists( $destinationPath ) ) Storage::deleteDirectory( $destinationPath );

        dd( $data );

        if($data!=""){

        $image = Image::make( base64_decode($data)  )->resize(400, 400);

        Storage::disk('local')->put( $destinationPath . $file_name,  $image->stream());

        }


        return '/storage/users/'.$id.'/' .$file_name;

    }







   
}
