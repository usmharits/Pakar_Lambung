<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model {
    protected $guarded = [];
    public function obats() {
        return $this->belongsToMany(Obat::class, 'obat_penyakit');
    }
}
