<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'year', 'genre', 'country', 'duration', 'director_id', 'img_url'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'year' => 'integer',
        'genre' => 'string',
        'country' => 'string',
        'duration' => 'integer',
        'img_url' => 'string'
        
    ];

    public $timestamps = true;

    public function actors(){
        return $this->belongsToMany(Actor::class);
    }
}

