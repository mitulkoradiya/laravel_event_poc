<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type_id',
        'image'
    ];

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function getImageUrlAttribute(){
        return Storage::url($this->image);
    }
}
