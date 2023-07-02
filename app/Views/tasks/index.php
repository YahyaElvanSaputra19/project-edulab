<!DOCTYPE html>
<html>

<head>
    <title>Daftar Tugas</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            // Fungsi Ajax untuk memperbarui status tugas
            $('body').on('change', '.statusCheckbox', function() {
                var checkbox = $(this);
                var status = checkbox.is(':checked') ? 1 : 0;
                var taskId = checkbox.data('task-id');
                $.ajax({
                    url: '/tasks/update/' + taskId,
                    type: 'POST',
                    data: {
                        status: status
                    },
                    success: function(response) {
                        // Tampilkan pesan sukses atau lakukan tindakan lain
                    }
                });
            });
            
        });
        $('#taskTable').DataTable({
            });
    </script>
</head>

<body>
    <h1>Daftar Tugas</h1>
    <table id="taskTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task) : ?>
                <tr>
                    <td><?= $task['judul'] ?></td>
                    <td>
                        <input type="checkbox" class="statusCheckbox" data-task-id="<?= $task['id'] ?>" <?= $task['status'] ? 'checked' : '' ?>>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="/tasks/edit/<?= $task['id'] ?>">Edit</a>
                        <a href="/tasks/<?= $task['id'] ?>" class="deleteButton" data-method="delete">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        $('#taskTable').DataTable({
            });
    </script>

    <h2>Tambah Tugas</h2>
    <form action="/tasks/create" method="post">
        <input type="text" name="judul" placeholder="Judul Tugas" required>
        <select name="status">
            <option value="0">Belum Selesai</option>
            <option value="1">Selesai</option>
        </select>
        <button type="submit">Tambah</button>
    </form>
</body>

</html>