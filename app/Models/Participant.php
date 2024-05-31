<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    protected $table = 'participants';
    protected $guarded = [];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }

    public function regispart()
    {
        return $this->belongsTo(Regispart::class);
    }
}
