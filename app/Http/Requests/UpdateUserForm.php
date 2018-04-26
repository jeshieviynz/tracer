<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Role;

class UpdateUserForm extends FormRequest
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

                
            'firstname' => 'required|regex:/^[a-zA-Z]+$/u|string|max:255',
            'lastname' => 'required|regex:/^[a-zA-Z]+$/u|string|max:255',
            'middlename' => 'required|regex:/^[a-zA-Z]+$/u|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            
            ];

    }

    public function persist(){
        
        
        $user = User::where( 'id', $this->get('id') )->first();
        //$user->username = $this->get('username');
        $user->firstname = $this->get('firstname');
        $user->lastname = $this->get('lastname');
        $user->middlename = $this->get('middlename');
        $user->email = $this->get('email');

        if( !empty($this->get('password'))){

            $user->password = bcrypt($this->get('password'));
        }


        $user->role_id = $this->get('userrole');
        $user->status = 1;
        $user->update();

    }
}
