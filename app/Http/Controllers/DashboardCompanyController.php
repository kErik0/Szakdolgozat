<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class DashboardCompanyController extends Controller
{
    /**
     * Show the dashboard with all companies.
     */
    public function index(Request $request)
    {
        $query = Company::query();

        // Keresés név vagy cím alapján
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('address', 'like', '%' . $request->search . '%');
        }

        $companies = $query->paginate(24);

        return view('dashboard-company', compact('companies'));
    }

    public function show(Company $company)
    {
        return view('companies', compact('company'));
    }
}
