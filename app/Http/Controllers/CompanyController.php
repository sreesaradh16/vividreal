<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct()
    {
        $this->companyService = new CompanyService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of($this->companyService->getCompanies())
                ->addIndexColumn()
                ->addColumn('logo', function ($company) {
                    $logo =  '<img src="' . asset($company->logo_url) . '" width="100" height="100">';
                    return $logo;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm"><iconify-icon icon="material-symbols:edit-outline"></iconify-icon></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm"><iconify-icon icon="fluent:delete-32-regular"></iconify-icon></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:companies',
            'logo' => 'nullable|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=100,min_height=100',
        ]);

        DB::beginTransaction();
        try {
            $this->companyService->store($request->all());
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors('Something went wrong');
        }
        DB::commit();
        return redirect()->route('companies.index')->with('success', 'Company added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('company.edit', [
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|unique:companies,name,' . $company->id,
            'logo' => 'nullable|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=100,min_height=100',
        ]);

        DB::beginTransaction();
        try {
            $this->companyService->update($company, $request->all());
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Something went wrong');
        }
        DB::commit();
        return redirect()->route('companies.index')->withSuccess('Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        DB::beginTransaction();
        try {
            $this->companyService->delete($company);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Something went wrong');
        }
        DB::commit();
        return redirect()->route('companies.index')->withSuccess('Company deleted successfully');
    }
}
