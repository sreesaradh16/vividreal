<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Services\CompanyService;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    protected $employeeService;
    protected $companyService;

    public function __construct()
    {
        $this->employeeService = new EmployeeService();
        $this->companyService = new CompanyService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of($this->employeeService->getEmployees())
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm"><iconify-icon icon="material-symbols:edit-outline"></iconify-icon></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm"><iconify-icon icon="fluent:delete-32-regular"></iconify-icon></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create', [
            'companies' => $this->companyService->getCompanies(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $this->employeeService->store($request->all());
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors('Something went wrong');
        }
        DB::commit();
        return redirect()->route('employees.index')->with('success', 'Employee added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employee.edit', [
            'employee' => $employee,
            'companies' => $this->companyService->getCompanies(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'company_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $this->employeeService->update($employee, $request->all());
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Something went wrong');
        }
        DB::commit();
        return redirect()->route('employees.index')->withSuccess('Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        DB::beginTransaction();
        try {
            $this->employeeService->delete($employee);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Something went wrong');
        }
        DB::commit();
        return redirect()->route('employees.index')->withSuccess('Employee deleted successfully');
    }
}
