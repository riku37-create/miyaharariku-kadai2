<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;//並び替え

class Product extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season', 'product_id', 'season_id');
    }

    // ローカルスコープ
    public function scopeNameSearch($query, $name)
    {
        if (!empty($name)) {
        $query->where('name', 'like', '%' . $name . '%');
    }
    }

}
