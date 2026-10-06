<?php

namespace App\Models;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class DonationGood extends Model
{
    protected $table = 'donation_goods';

    public function donation(){
        return $this->belongsTo(Donation::class, 'donation_id');
    }
}
