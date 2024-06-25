<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    public $timestamps = false;
    protected $guarded = [];

    public function barang()
    {
        return $this->hasOne(Barang::class, 'id', 'id_barang');
    }

}
