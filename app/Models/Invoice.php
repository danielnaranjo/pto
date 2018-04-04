<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'title',
        'price',
        'payment_status'
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'invoice_id');
    }

    public function getPaidAttribute() {
    	if ($this->payment_status == 'Invalid') {
    		return false;
    	}
    	return true;
    }
}
