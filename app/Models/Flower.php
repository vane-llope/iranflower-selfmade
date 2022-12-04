<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = ['name','tags','summary','introduction','irrigation','light','temperature','soil','compost'];

    public static function getFormInputs(){
        $FormInputs =   [
            ["type" => "text" ,"name" => "name" , "value" => "Name" , "rule" => "required"],
            ["type" => "textarea" , "name" => "summary"  ,"value" => "Summary","rule" => "required"],
            ["type" => "textarea" , "name" => "introduction" ,"value" => "Introduction","rule" => "required"],
            ["type" => "textarea" , "name" => "irrigation" , "value" => "Irrigation","rule" => "required"],
            ["type" => "textarea" , "name" => "light" ,"value" => "Light","rule" => "required"],
            ["type" => "textarea" , "name" => "temperature" ,"value" => "Temperature","rule" => "required"],
            ["type" => "textarea" , "name" => "soil"  ,"value" => "Soil","rule" => "required"],
            ["type" => "textarea" , "name" => "compost" ,"value" => "Compost","rule" => "required"],
            ["type" => "text" ,"name" => "tags" , "value" => "Tags" ,"rule" => "required"],
        ];
       
        return $FormInputs;
    }
    public static function getPath(){
        return ("/flowers");
    }
    public function scopeFilter($quary,array $filters){
        if($filters['tag'] ?? false){
            $quary->where('tags','like','%'.request('tag').'%');
        }
        if($filters['search'] ?? false){
            $quary->where('tags','like','%'.request('search').'%')
            ->orWhere('name','like','%'.request('search').'%')
            ->orWhere('summary','like','%'.request('search').'%')
            ->orWhere('irrigation','like','%'.request('search').'%')
            ->orWhere('light','like','%'.request('search').'%')
            ->orWhere('temperature','like','%'.request('search').'%')
            ->orWhere('soil','like','%'.request('search').'%')
            ->orWhere('compost','like','%'.request('search').'%');
        }
    }
}
