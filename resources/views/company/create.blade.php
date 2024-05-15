@extends("layouts.admin.app")

@section("heading")
<h1>Add Company</h1>
@endsection

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('companies.index')}}">Manage Company</a>
    </li>
    <li class="breadcrumb-item active">Add Company</li>
</ol>
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    {{ html()->form('POST')->route('companies.store')->attributes(['autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'company_add'])->open() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Logo</label>
                                    <input type="file" name="logo" id="logo" accept="image/jpeg, image/png, image/jpeg" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Website</label>
                                    <input type="url" name="website" id="website" value="{{ old('website') }}" class="form-control">
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
    initJqueryValidator("#company_add", {
        rules: {
            name: "required",
        },
        messages: {
            name: "Name is required",
        },
    });
</script>
@endpush