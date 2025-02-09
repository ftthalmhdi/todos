<?php

namespace App\Http\Controllers; // Define namespace

use App\Models\ToDoList; // Import ToDoList
use Illuminate\Http\Request; // Import Request
use Illuminate\Support\Facades\Auth; // Import Auth
use Carbon\Carbon; // Import Carbon

class ToDoListController extends Controller // Define class ToDoListController extends Controller
{
    public function index() // Define index method
    {

        //Menambahkan fitur untuk menampilkan tanggal sekarang
        $hariIni = Carbon::now()->translatedFormat('l, d F Y H:i:s'); // Format: Hari, Tanggal Bulan Tahun Jam:Menit:Detik

        // Menambahkan fitur untuk menampilkan data hanya untuk hari ini
        $tanggalHariIni = Carbon::now()->toDateString(); // Format: YYYY-MM-DD

        // Ambil data hanya untuk hari ini berdasarkan created_at
        $todolists = ToDoList::where('user_id', Auth::id()) // Filter berdasarkan user_id
            ->whereDate('created_at', $tanggalHariIni) // Filter berdasarkan tanggal hari ini
            ->get(); // Ambil semua data
        return view('dashboard', compact('todolists', 'hariIni')); // Kirim data ke view
    }

    public function store(Request $request) // Define store method
    {
        $request->validate([ // Validasi input
            'nama_tugas' => 'required|string|max:255', // Nama tugas harus diisi, bertipe string, maksimal 255 karakter
        ]);

        ToDoList::create([ // Simpan data ke database
            'user_id' => Auth::id(), // Ambil user_id dari Auth
            'nama_tugas' => $request->nama_tugas, // Ambil nama_tugas dari input
            'status_tugas' => 'pending', // Set status_tugas ke pending
        ]);

        return redirect()->route('dashboard')->with('success', 'Tugas berhasil ditambahkan!'); // Redirect ke dashboard dengan pesan sukses
    }

    public function update(Request $request, ToDoList $todolist)
    {
        if ($todolist->user_id !== Auth::id()) { // Cek apakah user_id pada ToDoList sama dengan user_id yang sedang login
            return redirect()->route('dashboard')->with('error', 'Akses ditolak!'); // Redirect ke dashboard dengan pesan error
        }

        $todolist->update([
            'status_tugas' => $request->status_tugas, // Update status_tugas
        ]);

        return redirect()->route('dashboard')->with('success', 'Status tugas diperbarui!'); // Redirect ke dashboard dengan pesan sukses
    }

    public function destroy(ToDoList $todolist)
    {
        if ($todolist->user_id !== Auth::id()) { // Cek apakah user_id pada ToDoList sama dengan user_id yang sedang login
            return redirect()->route('dashboard')->with('error', 'Akses ditolak!'); // Redirect ke dashboard dengan pesan error
        }

        $todolist->delete(); // Hapus data
        return redirect()->route('dashboard')->with('success', 'Tugas berhasil dihapus!'); // Redirect ke dashboard dengan pesan sukses
    }

    public function edit(ToDoList $todolist)
    {
        if ($todolist->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak!');
        }

        return view('edit_todolist', compact('todolist'));
    }

    public function updateNama(Request $request, ToDoList $todolist)
    {
        if ($todolist->user_id !== Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'nama_tugas' => 'required|string|max:255',
        ]);

        $todolist->update([
            'nama_tugas' => $request->nama_tugas,
        ]);

        return redirect()->route('dashboard')->with('success', 'Nama tugas berhasil diperbarui!');
    }

    public function history()
    {
        $todolists = ToDoList::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get(); // Ambil data berdasarkan user_id dan urutkan berdasarkan created_at secara descending

        return view('history_todolist', compact('todolists')); // Kirim data ke view
    }
}
