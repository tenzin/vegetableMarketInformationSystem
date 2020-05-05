<?php

namespace App;
use App\ProductType;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'tbl_product_types';
    protected $primaryKey = 'id';
    protected $fillable= ['type'];
    public $timestamps = false;
}
