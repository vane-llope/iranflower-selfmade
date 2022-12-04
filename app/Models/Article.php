<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    use HasFactory;
    use Uuid;
    protected $fillable = ['name','tags','introduction','content','createdby','updatedby'];

    public static function getFormInputs(){
        $FormInputs =   [
            ["type" => "text" ,"name" => "name" , "value" => "Name" , "rule" => "required"],
            ["type" => "textarea" , "name" => "introduction"  ,"value" => "Introduction","rule" => "required"],
            ["type" => "textarea" , "name" => "content"  ,"value" => "Content","rule" => "required"],
            ["type" => "text" ,"name" => "tags" , "value" => "Tags" ,"rule" => "required"],
        ];
       
        return $FormInputs;
    }
    public function scopeFilter($quary,array $filters){
        if($filters['tag'] ?? false){
            $quary->where('tags','like','%'.request('tag').'%');
        }
        if($filters['search'] ?? false){
            $quary->where('tags','like','%'.request('search').'%')
            ->orWhere('name','like','%'.request('search').'%')
            ->orWhere('introduction','like','%'.request('search').'%');
        }
    }
    public static function getPath(){
        return ("/articles");
    }
  
}
