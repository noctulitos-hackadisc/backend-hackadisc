<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'intervened_competencies',
        'duration',
        'description',
    ];

    /**
     * Get the interventions for the intervention type.
     */
    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }
}
