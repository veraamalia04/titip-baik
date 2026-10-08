<?php

namespace App\Http\Controllers;

use App\Http\Requests\Donation\CreateDonationRequest;
use App\Http\Requests\Donation\UpdateDonationRequest;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    public function updateDonation(Donation $donation, UpdateDonationRequest $request){
        if (Str::lower($donation->status) != 'draft') return back()->with('error', 'Tidak bisa mengganti data');

        $data = $request->validated();

        $donation->donature_name = $data['donature_name'] ?? $donation->donature_name;
        $donation->donature_phone = $data['donature_phone'] ?? $donation->donature_phone;
        $donation->donature_email = $data['donature_email'] ?? $donation->donature_email;
        $donation->donature_address = $data['donature_address'] ?? $donation->donature_address;

        $donation->category_id = $data['category_id'] ?? $donation->category_id;
        $donation->operator_id = Auth::id();

        $donation->save();

        return back()->with('success', 'Berhasil mengganti data donasi');
    }
}
