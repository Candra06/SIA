<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['id_user', 'id_akun', 'tanggal_transaksi', 'jenis_transaksi', 'saldo'];
}
