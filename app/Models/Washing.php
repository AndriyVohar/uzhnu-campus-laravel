<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Washing extends Model
{
    use HasFactory;
    protected $fillable = [
        'day',
        'dormitory',
        'washing_machine_num',
        'hour',
        'user_id'
    ];
    public function creator() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
