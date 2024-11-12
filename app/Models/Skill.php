<?php

namespace App\Models;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'skill_user', 'skill_id', 'user_id');
    }
}
