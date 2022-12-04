<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Uuid;
    protected $fillable = ['name','tags','description','user_id'];

    public static function getFormInputs(){
        $FormInputs =   [
            ["type" => "text" ,"name" => "name" , "value" => "Name" , "rule" => "required"],
            ["type" => "textarea" , "name" => "description"  ,"value" => "Description","rule" => "required"],
            ["type" => "text" ,"name" => "tags" , "value" => "Tags" ,"rule" => "required"],
        ];
       
        return $FormInputs;
    }
    public static function getPath(){
        return ("/products");
    }
    public function scopeFilter($quary,array $filters){
        if($filters['tag'] ?? false){
            $quary->where('tags','like','%'.request('tag').'%');
        }

        if($filters['search'] ?? false){
            $quary->where('tags','like','%'.request('search').'%')
            ->orWhere('name','like','%'.request('search').'%')
            ->orWhere('description','like','%'.request('search').'%');
        }
    }
       //relationship betwwen users and products
   public function user() {
    return $this->belongsTo(User::class, 'user_id');
}
}
