<?php

namespace App\Http\Controllers;

use App\Http\Requests\Donation\CreateDonationCategoryRequest;
use App\Http\Requests\Donation\UpdateCategoryNameRequest;
use App\Models\DonationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationCategoryController extends Controller
{
    public function createDonationCategory(CreateDonationCategoryRequest $request){
        $data = $request->validated();

        $exists = DonationCategory::where('name', $data['name'])->exists();

        if ($exists) return back()->with('error', 'Category sudah ada');

        
        $donation_category = DonationCategory::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ]);

        return back()->with('success', 'Berhasil menambahkan category');
    }

    public function  updateCategoryName(DonationCategory $donationCategory, UpdateCategoryNameRequest $request){
        $data = $request->validated();

         $exists = DonationCategory::where('name', $data['name'])->exists();

        if ($exists) return back()->with('error', 'Category sudah ada');

        $donationCategory->name = $data['name'];
        $donationCategory->slug = Str::slug($data['name']);

        $donationCategory->save();

        return back()->with('success', 'Berhasil mengubah nama');
    }
}
