<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyService
{
    public function getCompany($id)
    {
        return Company::where('id', $id);
    }

    public function getCompanies()
    {
        return Company::get();
    }

    public function store($data)
    {
        if (isset($data['logo'])) {
            $path = $data['logo']->store('company', 'public');
        }

        return Company::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'logo' => $path ?? '',
            'website' => $data['website']
        ]);
    }

    public function update($company, $data)
    {
        if (isset($data['logo'])) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $company->logo = $data['logo']->store('company', 'public');
        }

        $company->name = $data['name'];
        $company->email = $data['email'];
        $company->website = $data['website'];
        $company->save();
        return $company;
    }

    public function delete($company)
    {
        $company->delete();
    }
}
