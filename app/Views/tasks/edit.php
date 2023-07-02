<!DOCTYPE html>
<html>

<head>
    <title>Edit Tugas</title>
</head>

<body>
<h2>Edit Task</h2>

<form method="post" action="/tasks/update/<?= $task['id'] ?>">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="<?= $task['judul'] ?>">
    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="0" <?= $task['status'] == 0 ? 'selected' : '' ?>>Belum Selesai</option>
        <option value="1" <?= $task['status'] == 1 ? 'selected' : '' ?>>Selesai</option>
    </select>

    <button type="submit">Update Task</button>
</form>
</body>

</html>