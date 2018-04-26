<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;
use App\Role;
use App\alumni;


class AlumnidetailsForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
         return [

                
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'student_id' => 'required|string|max:10|min:10|unique:users',
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            
            ];

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $record = alumni::where( 'id', $this->get('id') )->first();
        $record->username = $this->get('username');
        $record->firstname = $this->get('firstname');
        $record->lastname = $this->get('lastname');
        $record->middlename = $this->get('middlename');
        $record->email = $this->get('email');
        $record->update();
    }
}
