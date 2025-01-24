<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produks';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nama_produk', 'kategori_produk', 'harga_beli', 'harga_jual', 'stok_produk', 'foto'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
