<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        "manager_id",
        "user_id",
        "title",
        "description",
        "status"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];
}
