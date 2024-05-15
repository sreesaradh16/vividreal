<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct()
    {
        $this->companyService = new CompanyService();
    }

    public function list(Request $request)
    {
        $companies =  $this->companyService->getCompanies();

        if ($companies) {
            return response()->json(['status' => true, 'companies' => $companies]);
        }
    }
}
