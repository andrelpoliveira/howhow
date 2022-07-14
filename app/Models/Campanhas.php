<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campanhas extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'campaign_name',
        'start_date',
        'finish_date',
        'type',
        'funds',
        'content',
        'filter_category',
        'filter_engagement',
        'marca_id'
    ];

    public function marca()
    {
        return $this->belongsTo(User::class);
    }
}
