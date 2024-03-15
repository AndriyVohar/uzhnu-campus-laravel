<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'tag',
      'imgURL',
      'user_id',
      'status',
    ];
    public function creator() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
