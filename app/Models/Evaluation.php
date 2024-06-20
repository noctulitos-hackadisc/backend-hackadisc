<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'adaptability_to_change',
        'safe_conduct',
        'dynamism_energy',
        'personal_effectiveness',
        'initiative',
        'working_under_pressure',
        'date',
    ];

    /**
     * Get the user that owns the Evaluation
     */
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    /**
     * Get the intervention for the evaluation.
     */
    public function Intervention()
    {
        return $this->hasMany(Intervention::class);
    }
}
