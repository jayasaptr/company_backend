<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function show($id)
    {
        $company = Company::find(1);
        return view('pages.company.show', compact('company'), ['type_menu' => 'company']);
    }

    public function edit(Company $company)
    {
        return view('pages.company.edit', compact('company'), ['type_menu' => 'company']);
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
        ]);


        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'radius' => $request->radius,
            'time_in' => $request->time_in,
            'time_out' => $request->time_out,
        ]);

        return redirect()->route('companies.show', 1)->with('success', 'Company updated successfully');
    }
}
