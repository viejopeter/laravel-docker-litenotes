<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];

    public function getRouteKeyname()
    {
        return 'uuid';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function notebook(){
        return $this->belongsTo(Notebook::class);
    }
}
