@extends('layouts.app')

@section('title', 'Riwayat To-Do List')

@section('header', 'Riwayat To-Do List')

@section('content')
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
@endsection
