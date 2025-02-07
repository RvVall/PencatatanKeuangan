@extends('layouts.app')

@section('content')
<div class="card p-4">
    <h2>Edit Transaksi</h2>
    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ $transaction->title }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="amount" class="form-control" value="{{ $transaction->amount }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis</label>
            <select name="type" class="form-select">
                <option value="income" {{ $transaction->type == 'income' ? 'selected' : '' }}>Pemasukan</option>
                <option value="expense" {{ $transaction->type == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control">{{ $transaction->description }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="transaction_date" class="form-control" value="{{ $transaction->transaction_date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
