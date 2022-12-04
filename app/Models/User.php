<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Uuid;
    protected $fillable = ['name','email','phone','company','address','idnumber','password'];

    public static function getFormInputs(){
        $FormInputs =   [
            ["type" => "text" ,"name" => "name" , "value" => "Name" , "rule" => "required"],
            ["type" => "text" ,"name" => "email" , "value" => "Email" ,"rule" => "required"],
            ["type" => "text" ,"name" => "phone" , "value" => "Phone" ,"rule" => "required"],
            ["type" => "text" ,"name" => "company" , "value" => "Company" ,"rule" => "required"],
            ["type" => "textarea" ,"name" => "address" , "value" => "Address" ,"rule" => "required"],
            ["type" => "text" ,"name" => "idnumber" , "value" => "ID Number" ,"rule" => "required"],
        ];
       
        return $FormInputs;
    }
    public static function getPath(){
        return ("/users");
    }

    public function scopeFilter($quary,array $filters){

        if($filters['search'] ?? false){
            $quary->where('name','like','%'.request('search').'%')
            ->orWhere('company','like','%'.request('search').'%');
        }
    }
    public function products() {
        return $this->hasMany(Product::class, 'user_id'); 
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
       
}
