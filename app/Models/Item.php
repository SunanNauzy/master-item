<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Item extends Model
{
    //use HasFactory;

    protected $guarded = false;

    public function path()
    {
        return url("/item/{$this->id}-" . Str::slug($this->name));
    }

    protected $table = "items";

    protected $fillable = ['name','qty','input_date','approval_status','user','unit','tipe','jenis_transaksi','bidang','kelompok','jenis','type','bulan','kode_barang'];
}
