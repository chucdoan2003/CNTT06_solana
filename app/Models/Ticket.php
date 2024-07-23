<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'Ticket';
    
    protected $fillable = [
        'name',
        'urlimage',
        'ngayphathanh',
        'ngayketthuc',
        'diachi',
        'giatien',
        'mota',
        'nguoitochuc',
        'noitochuc',
        'cateID'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cateID');
    }
   
    
}
