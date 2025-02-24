<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengajuan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Data Pengajuan</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pemohon</th>
                <th>Jenis Dokumen</th>
                <th>Status Pengajuan</th>
                <th>Status Pembayaran</th>
                <th>Tanggal Pengajuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuan as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_pemohon }}</td>
                    <td>{{ $item->layanan->nama_layanan ?? 'Tidak Ada' }}</td> 
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>{{ ucfirst($item->status_pembayaran) }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach     
        </tbody>
    </table>    
</body>
</html>
