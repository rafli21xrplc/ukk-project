<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
        }

        .content {
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>LAPORAN PEMBAYARAN SPP</h1>
        </div>

        <div class="content">
            <h2>Invoice</h2>
            <p>Date: {{ date('Y-m-d') }}</p>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>SISWA</th>
                        <th>PETUGAS</th>
                        <th>TAHUN</th>
                        <th>TANGGAL</th>
                        <th>NOMINAL</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pembayaran as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->siswa->name }}</td>
                            <td>{{ $item->petugas->nama_petugas }}</td>
                            <td>{{ $item->spp->tahun }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_bayar)->formatLocalized('%d %B %Y') }}</td>
                            <td>Rp.{{ number_format($item->jumlah_bayar, 2, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="my-5 flex justify-center w-full" style="min-height:16rem">
                                    <div class="my-auto">
                                        <img width="250" src="{{ asset('assets/content/empty-data.png') }}"
                                            alt="" srcset="">
                                        <span class="font-bold text-lg">Data Kosong!</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <p>Total: Rp.{{ number_format($total, 2, ',', '.') }}</p>
        </div>

        <div class="footer">
            <p>Developer By MSR</p>
        </div>
    </div>
</body>

</html>
