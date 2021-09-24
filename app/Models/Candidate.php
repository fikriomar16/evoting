<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = ['id_calon', 'nama_calon', 'id_wakil_calon', 'nama_wakil_calon', 'visi', 'misi', 'foto'];
    public function vote()
    {
        return $this->hasMany(Vote::class);
    }
}
