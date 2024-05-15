@extends("layouts.admin.list")

@section("heading")
<h1>Manage Employee</h1>
@endsection

@section("breadcrumb")
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Manage Employee</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header border-0">
        <a class="btn btn-info" href="{{ route('employees.create') }}">Add Employee</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Company</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employees.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: '#'
                },
                {
                    data: 'company.name',
                    name: 'company'
                },
                {
                    data: 'first_name',
                    name: 'First Name'
                },
                {
                    data: 'last_name',
                    name: 'Last Name'
                },
                {
                    data: 'email',
                    name: 'Email'
                },
                {
                    data: 'phone',
                    name: 'Phone'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $('.table').on('click', '.edit', function() {
            var data = table.row($(this).closest('tr')).data();
            var userId = data.id;
            window.location.href = '/vividreal/employee/' + userId + '/edit';
        });

        $('.table').on('click', '.delete', function() {
            var data = table.row($(this).closest('tr')).data();
            var userId = data.id;
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    },
                    method: "POST",
                    data: {
                        _method: 'delete',
                    },
                    url: '/vividreal/employee/' + userId,
                    type: 'DELETE',
                    success: function(response) {
                        table.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
@endpush