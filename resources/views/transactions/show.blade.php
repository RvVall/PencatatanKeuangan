@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="card p-4">
    <h2>Detail Transaksi</h2>

    <table class="table table-bordered">
        <tr>
            <th>Judul</th>
            <td>{{ $transaction->title }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>Rp{{ number_format($transaction->amount, 2) }}</td>
        </tr>
        <tr>
            <th>Jenis</th>
            <td>
                <span class="badge {{ $transaction->type == 'income' ? 'bg-success' : 'bg-danger' }}">
                    {{ $transaction->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                </span>
            </td>
        </tr>
        <tr>
            <th>Deskripsi</th>
            <td>{{ $transaction->description ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ date('d F Y', strtotime($transaction->transaction_date)) }}</td>
        </tr>
        <tr>
            <th>Dibuat pada</th>
            <td>{{ $transaction->created_at->format('d F Y H:i:s') }}</td>
        </tr>
        <tr>
            <th>Diperbarui pada</th>
            <td>{{ $transaction->updated_at->format('d F Y H:i:s') }}</td>
        </tr>
    </table>

    <div class="mt-3">
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</button>
        </form>
    </div>
</div>
@endsection
