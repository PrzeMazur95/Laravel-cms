<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user(){

       return $this->belongsTo('App\Models\User');

    }
//mutator, zmienia value zanim wrzuci do DB, w tym przypadku dodaje ścieżkę do public, żeby wrzucać poprawny path od db
//    public function setPostImageAttribute($value){
//
//    $this->attributes['post_image'] = asset($value);
//
//    }

// tutaj zastosujemy akcesor, zwraca zmieniony string z db o to co chcemy, w tym przypadku asset, czyli path do public/images

    public function getPostImageAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/' . $value);
    }
}
