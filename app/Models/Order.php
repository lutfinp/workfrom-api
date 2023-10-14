<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders'; // Sesuaikan dengan nama tabel Order Anda
    protected $fillable = ['customer_id', 'building_id', 'start', 'finish', 'price']; // Sesuaikan dengan kolom yang ada di tabel Order Anda

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id', 'id');
    }
}
