@extends('layouts.app')

@section('title', 'Dashboard Keuangan')

@section('content')
    <h2 class="mb-3">Dashboard Pencatatan Keuangan</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card mt-4 p-4 shadow-sm">
        <h3 class="mb-3">Grafik Pemasukan vs Pengeluaran</h3>
        <canvas id="transactionChart"></canvas>
    </div>

    <div class="card p-4 mt-4 shadow-sm">
        <h2 class="mb-4">Daftar Transaksi</h2>
        <a href="{{ route('transactions.create') }}" class="btn btn-success mb-3">Tambah Transaksi</a>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Jumlah</th>
                        <th>Jenis</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $month => $monthTransactions)
                        <tr><td colspan="5"><strong>{{ date('F Y', strtotime($month)) }}</strong></td></tr>
                        @foreach($monthTransactions as $transaction)
                            <tr>
                                <td>{{ $transaction->title }}</td>
                                <td>Rp{{ number_format($transaction->amount, 2) }}</td>
                                <td>
                                    <span class="badge {{ $transaction->type == 'income' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $transaction->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                                    </span>
                                </td>
                                <td>{{ $transaction->transaction_date }}</td>
                                <td>
                                    <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('transactionChart').getContext('2d');
    var transactionChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Pemasukan', 'Pengeluaran'],
            datasets: [{
                data: [{{ $income ?? 0 }}, {{ $expense ?? 0 }}],
                backgroundColor: ['#28a745', '#dc3545'],
                hoverOffset: 10
            }]
        }
    });
</script>
@endsection
