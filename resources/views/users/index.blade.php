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

    <script>
        $(document).ready(function() {
            // Khởi tạo DataTable
            var table = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("users.data") }}',
                    data: function(d) {
                        $('.column-search').each(function() {
                            var columnIndex = $(this).data('column');
                            var searchValue = this.value;
                            d.columns[columnIndex].search.value = searchValue;
                        });
                    }
                },
                columns: [
                    { data: 'name', name: 'name', sortable: false },
                    { data: 'email', name: 'email', sortable: false }
                ]
            });

            // Toggle filter row
            $('#filter-toggle').on('click', function() {
                $('#filter-row').toggle();
            });

            // Column search
            $('.column-search').on('keyup', function() {
                table.column($(this).data('column')).search(this.value).draw();
            });

            // Thiết lập jQuery Autocomplete cho từng cột nếu cần
            $(".column-search").autocomplete({
                source: function(request, response) {
                    var column = $(this.element).data('column-name'); // Lấy tên cột từ thuộc tính data
                    $.ajax({
                        url: "{{ route('autocomplete') }}",
                        dataType: "json",
                        data: {
                            term: request.term,
                            column: column // Gửi tên cột
                        },
                        success: function(data) {
                            response(data.slice(0, 10)); // Giới hạn 10 kết quả
                        }
                    });
                },
                select: function(event, ui) {
                    var column = $(this).data('column');
                    table.column(column).search(ui.item.value).draw();
                }
            });
        });
    </script>
</body>
</html>
