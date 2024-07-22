<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'ngayphathanh', 'ngayketthuc', 'diachi', 'giatien', 'mota', 'nguoitochuc', 'noitochuc', 'cateID'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cateID');
    }
}

