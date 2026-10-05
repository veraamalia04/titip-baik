<?php

namespace App\Http\Controllers;

use App\Http\Requests\Donation\CreateDonationRequest;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function createDonation(CreateDonationRequest $request){
        $data = $request->validated();
        
    }
}
