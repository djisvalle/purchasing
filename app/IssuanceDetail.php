<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssuanceDetail extends Model
{
    protected $table = 'issuance_detail';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'issuance_fk',
								'stock_no',
								'unit_fk',
								'item_fk',
								'quantity',
								'remarks',
								'is_active'
								//
								);
}