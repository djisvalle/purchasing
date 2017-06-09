<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acceptance extends Model
{
    protected $table = 'acceptance';
    
	protected $primaryKey = 'id';
	protected $fillable = array('id',
								'agency_fk',
								'supplier_fk',
								'po_fk',
								'po_no',
								'po_date',
								'iar',
								'invoice_no',
								'invoice_date',
								'requisitioning_dept_fk',
								'date_inspected',
								'verification',
								'inspector_fk',
								'date_accepted',
								'completeness',
								'property_officer_fk',
								'is_active'
								//
								);
}