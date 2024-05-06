<?php

namespace App\Models;

use App\Models\Tool;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'tool_id',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

   
}
