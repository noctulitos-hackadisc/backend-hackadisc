<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
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
     * Get the manager that owns the company.
     */
    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    /**
     * Get the posts that owns the company.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the company type that owns the company.
     */
    public function companyType()
    {
        return $this->belongsTo(CompanyType::class);
    }

    /**
     * Get the parent company that owns the company.
     */
    public function parentCompany()
    {
        return $this->belongsTo(Company::class, 'parent_company_id');
    }

    /**
     * Get the company's areas.
     */
    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    /**
     * Get the company's workers.
     */
    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}
