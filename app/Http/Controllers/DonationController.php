<?php

namespace App\Http\Controllers;

use App\Http\Requests\Donation\CreateDonationRequest;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function createDonation(CreateDonationRequest $request){
        $data = $request->validated();

        $donation = Donation::create([
            'donature_name' => $data['donature_name'],
            'donature_phone' => $data['donature_phone'],
            'donature_email' => $data['donature_email'],
            'donature_address' => $data['donature_address'],

            'category_id' => $data['category_id'],
            'operator_id' => Auth::id(),
        ]);

        $generatedRef = $donation->generateRef();

        $donation['no_ref'] = $generatedRef;
        $donation->save();

        return back();
    }
}
