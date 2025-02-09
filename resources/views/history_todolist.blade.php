<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat To-Do List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Riwayat To-Do List</h2>
        <p>Berikut adalah semua tugas yang pernah Anda buat.</p>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tugas</th>
                    <th>Status</th>
                    <th>Tanggal & Waktu Tugas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($todolists as $index => $todolist)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $todolist->nama_tugas }}</td>
                        <td>
                            @if ($todolist->status_tugas == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @else
                                <span class="badge bg-success">Completed</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($todolist->created_at)->translatedFormat('l, d F Y H:i:s') }} WIB
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>
    </div>
</body>

</html>
