@extends('layouts.app')

@section('content')
<div class="card p-4 shadow-sm">
    <h2>Tambah Transaksi</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>
            @error('amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis</label>
            <select name="type" class="form-select @error('type') is-invalid @enderror">
                <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Pemasukan</option>
                <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
            </select>
            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="transaction_date" class="form-control @error('transaction_date') is-invalid @enderror" value="{{ old('transaction_date') }}" required>
            @error('transaction_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
