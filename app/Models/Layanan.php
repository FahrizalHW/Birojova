<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanans';
    protected $primaryKey = 'id';

    protected $fillable = ['nama_layanan', 'deskripsi', 'harga_modal', 'harga_jual'];
}
