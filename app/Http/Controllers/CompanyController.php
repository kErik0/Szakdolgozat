<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function updateDescription(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string|max:1000',
        ]);

        $company = auth('company')->user();
        $company->description = $request->description;
        $company->save();

        return redirect()->route('profile.edit')->with('success', 'A cég leírása sikeresen frissítve.');
    }
}