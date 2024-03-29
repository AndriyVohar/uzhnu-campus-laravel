<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerTask extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'worker_id',
        'description',
        'status'
    ];
    public function creator() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
