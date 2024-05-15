<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService
{
    public function getEmployees()
    {
        return Employee::with('company')->get();
    }
    public function store($data)
    {
        return Employee::create([
            'company_id' => $data['company_id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone']
        ]);
    }

    public function update($employee, $data)
    {
        $employee->company_id = $data['company_id'];
        $employee->first_name = $data['first_name'];
        $employee->last_name = $data['last_name'];
        $employee->email = $data['email'];
        $employee->phone = $data['phone'];
        $employee->save();
        return $employee;
    }

    public function delete($employee)
    {
        $employee->delete();
    }
}
