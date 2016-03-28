<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface 
{

	protected $fillable = array('email', 'username', 'nombre', 'ubicacion', 'sexo');

	use UserTrait, RemindableTrait;

	public function isValid2($data)
    {
        $rules = array(
            'email'     =>  'required|max:50|email|unique:users',
            'username'  =>  'required|max:10|min:4'
        );

        if ($this->exists)
        {
            //Evitamos que la regla “unique” tome en cuenta el rif del Agente actual
            $rules['email'] .= ',email,' . $this->id;
        }        
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'password_temp', 'code', 'active', 'id_rol', 'remember_token');

	public function getAuthPassword()
	{
		return $this->password;
	}

}
