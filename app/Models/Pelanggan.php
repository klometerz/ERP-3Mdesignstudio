<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'kode_pelanggan', 'nama', 'alamat', 'kota', 'provinsi', 'zipcode',
        'negara', 'kode_negara', 'email', 'telepon', 'status_pelanggan', 'is_dummy'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
