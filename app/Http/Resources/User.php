<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordInterface;
use Illuminate\Notifications\Notifiable;
class User extends JsonResource implements CanResetPasswordInterface
{
    use Notifiable;
    use CanResetPassword;
    protected $token;

    public function __construct($resource, $token = null)
    {
        parent::__construct($resource);
        $this->token=$token;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'birthdate' => $this->birthdate,
            'type' => $this->type,
            'email' => $this->email,
            'role' => $this->role,
            'cellphone' => $this->cellphone,
            'truck'=>$this->truck!==null?$this->truck->license_plate:null
            ];
    }
}
