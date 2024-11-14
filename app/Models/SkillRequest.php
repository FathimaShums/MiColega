<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SkillRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proofDocuments()
    {
        return $this->hasMany(ProofDocument::class);
    }
}
