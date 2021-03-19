<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Inquire extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "desc",
        "ref_link",
        "checked"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
