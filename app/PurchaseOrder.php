<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }
    // public function rfqEmail()
    // {
    //     return $this->belongsTo(RfqEmail::class);
    // }
    public function supplier()
    {
        return $this->belongsTo(SupplierAccreditation::class,'supplier_id');
    }
}
