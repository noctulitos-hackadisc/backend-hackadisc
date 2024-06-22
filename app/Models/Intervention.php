<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'start_date',
        'intervened_competency',
    ];

    /**
     * Get the intervention type that owns the Intervention
     */
    public function interventionType()
    {
        return $this->belongsTo(InterventionType::class);
    }

    /**
     * Get the evaluation that owns the Intervention
     */
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    /**
     * Get the worker that owns the Intervention
     */
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
}
