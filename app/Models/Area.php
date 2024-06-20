<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
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
     * Get the company that owns the area.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the area chief that owns the area.
     */
    public function areaChief()
    {
        return $this->belongsTo(AreaChief::class);
    }

    /**
     * Get the workers for the area.
     */
    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}
