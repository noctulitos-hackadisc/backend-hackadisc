<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the user that owns the Post
     */
    public function workers()
    {
        return $this->hasMany(Worker::class);
    }

    /**
     * Get the company that owns the Post
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
