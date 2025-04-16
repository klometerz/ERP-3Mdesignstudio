<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id',
        'tanggal_order',
        'tanggal_selesai_order',
        'nilai_order',
        'status_order',
        'nama_pekerjaan',
        'foto_before',
        'foto_after',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function updatedBy()
{
    return $this->belongsTo(\App\Models\User::class, 'updated_by');
}

}
