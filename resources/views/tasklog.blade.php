<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Log Tugas</h1>
        
        <form action="{{ route('tasklog.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="task_name" class="form-label">Nama Tugas</label>
                <input type="text" class="form-control" id="task_name" name="task_name" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="completed">Selesai</option>
                    <option value="pending">Pending</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Log</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
