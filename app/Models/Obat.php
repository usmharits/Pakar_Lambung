<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model {
    protected $guarded = [];
    public function penyakits() {
        return $this->belongsToMany(Penyakit::class, 'obat_penyakit');
    }
}
