<?php

namespace App\Http\Controllers;

use App\Http\Requests\Donation\CreateDonationGoodProofRequest;
use App\Http\Requests\Donation\CreateDonationGoodRequest;
use App\Http\Requests\Donation\UpdateDonatedToRequest;
use App\Models\Donation;
use App\Models\DonationGood;
use Illuminate\Http\Request;

class DonationGoodController extends Controller
{
    public function createDonationGood(Donation $donation ,CreateDonationGoodRequest $request){
        $data = $request->validated();

        $donation->goods()->create([
            'goods_name' =>  $data['goods_name'],
            'amount' => $data['amount'],
            'donated_to' => $data['donated_to'] ?? null,

            'diterima_pada' => now(),
        ]);

        return back()->with('success', 'Berhasil menambahkan barang donasi');
    }

    public function updateTujuanDonasi(DonationGood $donationGood, UpdateDonatedToRequest $request){
        $data = $request->validated();

        $donationGood->donated_to = $data['donated_to'];

        $donationGood->save();

        return back()->with('success', 'Berhasil mengganti tujuan donasi');
    }

    public function updateDikirimPada(DonationGood $donationGood){
        if ($donationGood->dikirim_pada) return back('error', 'Barang sudah dikirim');

        $donationGood->dikirim_pada  = now();
        $donationGood->save();
        return back()->with('success', 'Berhasil');
    }

    public function updateDonationProof(DonationGood $donationGood , CreateDonationGoodProofRequest $request){
        $data = $request->validated();

        $file = $request->file('donation_photo_proof');
        $path = $file->store('uploads', 'public');

        $donationGood->donated_proof = $path;
        $donationGood->disalurkan_pada = now();
        $donationGood->save();

        return back()->with('success', 'Berhasil upload bukti');
    }
}
