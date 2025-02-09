<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit To-Do List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit To-Do List</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('todolist.updateNama', $todolist->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="nama_tugas" class="form-label">Nama Tugas</label>
                <input type="text" name="nama_tugas" class="form-control" value="{{ $todolist->nama_tugas }}"
                    required>
            </div>

            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>
