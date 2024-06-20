<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
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
     * Get the area that owns the worker.
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get the post that owns the worker.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the status that gets the worker
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the company that owns the worker.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the evaluations for the worker.
     */
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    /**
     * Get the interventions for the worker.
     */
    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }
}
