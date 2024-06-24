<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    // taru dibawah guarded
    protected static $searchableColumns = ['nama_barang', 'harga'];
    public static function search($term)
    {
        $query = self::query();
        
        foreach (self::$searchableColumns as $column) {
            $query->orWhere($column, 'like', '%' . $term . '%');
        }

        return $query;
    }
}
