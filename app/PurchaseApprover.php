<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseApprover extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
