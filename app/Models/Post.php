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

    //Odnośnie poniższego, teraz jest getPostImageAttribute, ponieważ nazwa kolumny w dob to post_image, jeżeli nazwa kolumny byłaby image, wtedy nazwa funkcji to getImageAttribute, taka jest konwencja
//mutator, zmienia value zanim wrzuci do DB, w tym przypadku dodaje ścieżkę do public, żeby wrzucać poprawny path od db
//    public function setPostImageAttribute($value){
//
//    $this->attributes['post_image'] = asset($value);
//
//    }

//lepiej korzystac z poniższego, ponieważ górna metoda na stałe w db zapisze zmianę, poniższa dynamicznie dodaje to cochcemy, zaznim zwróci nam variable
// tutaj zastosujemy akcesor, zwraca zmieniony string z db o to co chcemy, w tym przypadku asset, czyli path do public/images

    public function getPostImageAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/' . $value);
    }
}
