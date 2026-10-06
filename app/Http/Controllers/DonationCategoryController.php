<?php

namespace App\Http\Controllers;

use App\Http\Requests\Donation\CreateDonationCategoryRequest;
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
}
