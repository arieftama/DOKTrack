<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Absensi Hari Ini</h1>
        
        <form action="{{ route('attendance.checkIn') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="check_in" class="form-label">Waktu Check-in</label>
                <input type="text" class="form-control" id="check_in" name="check_in" value="{{ now()->format('H:i:s') }}" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Check-in</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
