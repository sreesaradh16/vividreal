@extends("layouts.admin.app")

@section("heading")
<h1>Edit Employee</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Manage Employee</a>
    </li>
    <li class="breadcrumb-item active">Edit Employee</li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    {{ html()->form('PUT')->route('employees.update',[$employee->id])->attributes(['autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'company_edit'])->open() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Company</label>
                                    <select class="form-select" name="company_id" id="company_id">
                                        <option value="" disabled selected>Select Company</option>
                                        @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ $company->id == $employee->company_id ? 'selected' : ''}}>{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') ?? $employee->first_name }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name')  ?? $employee->last_name }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email')  ?? $employee->email }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="number" name="phone" id="phone" value="{{ old('phone')  ?? $employee->phone }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push("scripts")
<script>
    initJqueryValidator("#company_edit", {
        rules: {
            name: "required",
        },
        messages: {
            name: "Name is required",
        },
    });
</script>
@endpush