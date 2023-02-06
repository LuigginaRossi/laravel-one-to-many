<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable= ["name","type_id", "description", "cover_img", "github_link", "completed" ];

    //un projetto corrisponde a una sola tipologia
    public function tipe(){
        return $this->belongsTo(Type::class);
    }
}
