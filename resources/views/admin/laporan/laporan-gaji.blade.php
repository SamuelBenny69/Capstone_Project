<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        @page {
            size: A4;
            margin: 15mm 10mm 15mm 10mm;
            margin: 0 0 0;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.3;
            color: #333;
        }

        .title {
            text-align: center;
            margin-bottom: 15px;
        }

        .title h2 {
            margin: 0;
            color: #444;
            font-size: 18px;
        }

        .title h5 {
            margin: 3px 0;
            color: #666;
            font-size: 13px;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .main-table th,
        .main-table td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }

        .main-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }

        .main-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .summary-section {
            margin-top: 20px;
            border-top: 2px solid #444;
            padding-top: 15px;
        }

        .summary-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #444;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }

        .summary-table td {
            padding: 5px;
            vertical-align: top;
            border: none;
        }

        .summary-label {
            font-weight: bold;
            color: #666;
            font-size: 10px;
        }

        .summary-value {
            color: #333;
            font-size: 11px;
        }

        .text-right {
            text-align: right;
        }

        @media print {
            thead {
                display: table-header-group;
            }
        }

        body {
            margin-top: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        .header {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 5px;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        .company-name {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .company-address {
            font-size: 10pt;
            line-height: 1.3;
        }

        .document-title {
            font-size: 16pt;
            font-weight: bold;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">


    <table class="header" cellpadding="0" cellspacing="0">
        <tr>
            <td width="25%" style="vertical-align: top; padding-right: 15px; padding-bottom: 10px">
                <img src="{{ asset('assets/img/illustrations/company.jpg') }}" alt="Logo Perusahaan" class="logo">
            </td>
            <td width="75%" style="vertical-align: top;">
                <div class="company-name"> PT Gun Shop</div>
                <div class="company-address">
                    Jalan Gundul Perkasa (RT 00/RW 00) No. 404, Kel. Botak Cemerlang,<br>
                    Kec. Bekasi Berkilau, 90210<br>
                    Telp: 0856-BATU-KECE (0856-2288-5323) | Email: samuelbenny@gmail.com
                </div>
            </td>
        </tr>
    </table>

    <div class="title">
        <h2>Laporan Gaji Karyawan</h2>
        <h5>Periode 01/01/2023 - 31/12/2023</h5>
        <h5>Jenis Gaji Karyawan: Semua</h5>
    </div>

    <table class="main-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Jabatan</th>
                <th>Tanggal Gajian</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan Kehadiran</th>
                <th>Tunjangan Keluarga</th>
                <th>Asuransi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gaji_karyawans as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $item->karyawan->nama }}</td>
                    <td class="text-center">{{ $item->karyawan->jabatan->jabatan ?? 'N/A' }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tgl_gaji)->format('d/m/Y') }}</td>
                    <td class="text-center">Rp {{ number_format($item->gaji->gaji_pokok, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->gaji->tunjangan_hadir, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->gaji->tunjangan_keluarga, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->gaji->asuransi, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-section">
        <h3 class="summary-title">Ringkasan Laporan Gaji</h3>
        <table class="summary-table">
            <tr>
                <td width="25%">
                    <div class="summary-label">Total Gaji:</div>
                    <div class="summary-value"><strong>Rp {{ number_format($totalGaji, 0, ',', '.') }}</strong></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="summary-label">Total Tunjangan Kehadiran:</div>
                    <div class="summary-value">Rp {{ number_format($totalTunjanganKehadiran, 0, ',', '.') }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="summary-label">Total Tunjangan Keluarga:</div>
                    <div class="summary-value">Rp {{ number_format($totalTunjanganKeluarga, 0, ',', '.') }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="summary-label">Total Asuransi:</div>
                    <div class="summary-value">Rp {{ number_format($totalAsuransi, 0, ',', '.') }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="summary">
        <p class="text-right">Nama Admin: <strong>Haji Ibrahim</strong></p>
        <p class="text-right">Tanggal Cetak: <strong>31/12/2023 23:59:59</strong></p>
    </div>
</body>

</html>
