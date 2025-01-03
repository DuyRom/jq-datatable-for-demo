<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel DataTable with Ajax</title>
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI JS -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    <div class="container mt-4">
        <button id="filter-toggle" class="btn btn-primary mb-3">Filter</button>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Email</th>
                </tr>
                <tr id="filter-row" style="display:none;">
                    <th><input type="text" class="column-search form-control" data-column="0" data-column-name="name" placeholder="Tìm tên"></th>
                    <th><input type="text" class="column-search form-control" data-column="1" data-column-name="email" placeholder="Tìm email"></th>
                </tr>
            </thead>
            <tbody>
                <!-- Dữ liệu sẽ được tải qua Ajax -->
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/datatable.js') }}"></script>

    <script>
        $(document).ready(function() {
            const dataTableManager = new DataTableManager(
                'example',
                '{{ route("users.data") }}',
                [
                    { data: 'name', name: 'name', sortable: false },
                    { data: 'email', name: 'email', sortable: false }
                ],
                '{{ route("autocomplete") }}'
            );
            dataTableManager.initialize();
        });
    </script>

</body>
</html>
