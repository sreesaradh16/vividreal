@extends("layouts.admin.list")

@section("heading")
<h1>Manage Company</h1>
@endsection

@section("breadcrumb")
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Manage Company</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header border-0">
        <a class="btn btn-info" href="{{ route('companies.create') }}">Add Company</a>
    </div>
    <div class="card-body">
        <table class="table data-table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Logo</th>
                    <th>Website</th>
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
            ajax: "{{ route('companies.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: '#'
                },
                {
                    data: 'name',
                    name: 'Name'
                },
                {
                    data: 'email',
                    name: 'Email'
                },
                {
                    data: 'logo_url',
                    name: 'logo',
                    render: function(data, type, full, meta) {
                        return "<img src=\"" + data + "\" height=\"50\"/>";
                    }
                },
                {
                    data: 'website',
                    name: 'Website'
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
            window.location.href = '/vividreal/company/' + userId + '/edit';
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
                    url: '/vividreal/company/' + userId,
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