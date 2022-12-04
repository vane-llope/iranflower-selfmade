<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = ['name','flower','allproducts','product','article','role','setrole','user'];
    public static function getFormInputs(){
        $FormInputs =   [
            ["type" => "text" ,"name" => "name" , "value" => "Name"],
            ["type" => "text" ,"name" => "flower" , "value" => "Flower" ],
            ["type" => "text" , "name" => "product"  ,"value" => "Product"],
            ["type" => "text" , "name" => "allproducts"  ,"value" => "All Products"],
            ["type" => "text" , "name" => "article"  ,"value" => "Article"],
            ["type" => "text" , "name" => "user"  ,"value" => "User"],
            ["type" => "text" , "name" => "role"  ,"value" => "Role"]
        ];
       
        return $FormInputs;
    }

    public function scopeFilter($quary,array $filters){

        if($filters['search'] ?? false){
            $quary->where('name','like','%'.request('search').'%')
            ->orWhere('id','like','%'.request('search').'%');
        }
    }

    public static function getPath(){
        return ("/roles");
    }

}
