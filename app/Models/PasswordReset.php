<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'password_resets';
    protected $primaryKey = 'email';

    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'email', 'email');
    }
    public function getEmailAttribute(){

    return $this->attributes['email'];
   }
    public function setEmailAttribute($value){
        
       return $this->attributes['email'] = $value;
    }
}
