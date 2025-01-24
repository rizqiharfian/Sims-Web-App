<?php

namespace App\Models;

use Illuminate\Database\Eloquent\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table='transactions';
    protected $primarykey='id';
    protected $fillable=['id','user_id','mobil_id','nama','ponsel','lama','alamat','tgl_pesan','total','status'];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
    public function mobil(): BelongsTo
    {
        return $this->BelongsTo(Mobil::class);
    }
}
