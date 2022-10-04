<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'products';

    protected $fillable = ['description','price', 'type', 'status'];

    public static function searchProducts( $keyWord, $paginateNumber, $keyTypes )
    {
        $searchResult = DB::table('products');

        if ( $keyWord ) {
            $searchResult->orWhere('description', 'LIKE', '%'.$keyWord.'%')
                ->orWhere('price', 'LIKE', '%'.$keyWord.'%');
        }


        if ( $keyTypes ) {
            $searchResult->orWhere('type', $keyTypes);
        }

        $results = $searchResult->paginate($paginateNumber);

        return $results;
    }

}
