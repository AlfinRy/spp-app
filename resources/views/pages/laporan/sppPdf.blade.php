<html>

<head>

    <title>Data SPP Sudah Lunas</title>
    <link rel="shortcut icon" href="{{ asset('img/logo/favicon.ico') }}" type="image/x-icon">

    {{-- <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}"> --}}
    <style type="text/css">
        /* body {
            font-family: sans-serif;
        } */

        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            /* border: 1px solid #3c3c3c; */
            padding: 3px 8px;
        }

        table td {
            vertical-align: top;
        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }

        .table {
            border: none;
        }

        .hh tr td {
            border: 0;
            padding: 0
        }

        .hh {
            margin-bottom: 2px;
        }
    </style>
</head>

<body>
    <table class="table">
        <tr>
            <td>
                {{-- <img src="tes.png" alt=""> --}}
            </td>
            <td colspan="3" class="text-center" style="width: 200px; text-align: center;">
                <h3 class="text-center" style="text-align: center">YAYASAN PELITA NUSANTARA BOGOR</h3>
                <h2 style="text-align: center">SMK PLUS PELITA NUSANTARA BOGOR</h2>
                <h4>TERAKREDITASI A "UNGGUL"</h4>
                <p style="font-size: 13px">JL. Golf Ciriung-Cibinong Tlp/Fax. (021) 83713168</p>
            </td>
            <td>
                <img src="<?{{ asset('img/logo/logo-penus.png') }}?>" alt="">
                {{-- <img src="asset/img/logo/logo-penus.png" alt=""> --}}
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="font-size: 10px; width: 30%;">Website http://www.smkpluspnb.sch.id</td>
            <td style="font-size: 10px; width: 25%;">e-mail : smkpluspnb@gmail.com</td>
            <td style="font-size: 10px; width: 15%;">NPSN : 69978524</td>
            {{-- <td style="font-size: 10px; text-align: center;">
                Website http://www.smkpluspnb.sch.id e-mail : smkpluspnb@gmail.com
                NPSN : 69978524
            </td> --}}
            {{-- <td>
                <p style="font-size: 12px">Website http://www.smkpluspnb.sch.id</p>
                <p style="font-size: 12px">e-mail : smkpluspnb@gmail.com</p>
                <p style="font-size: 12px">NPSN : 69978524</p>
            </td> --}}
            <td></td>
        </tr>
    </table>

    <table>
        <tr>
            <td>No</td>
            <td>Nama Siswa</td>
            <td>Kelas</td>
            <td>Tanggal Transaksi</td>
            <td>SPP Bulan</td>
        </tr>
        <?php $no = 1; ?>
        @foreach ($spp as $k)
            <tr>
                <td><?= $no++ ?></td>
                <td>{{ $k->siswa->nama }}</td>
                <td>{{ $k->siswa->kelas->nama_kelas }}</td>
                <td>{{ $k->tgl_transaksi }}</td>
                <td>{{ $k->bulan }}</td>
            </tr>
        @endforeach
    </table>
    {{-- <table class="hh">
        <tr>
            <td>

            </td>
            <td style="text-align: center;padding-center: -20px;">
                <?php $src = asset('img/logo/logo-penus2.png'); ?>
                <img style="width: 60px;height: 100px;" src="<?= $src ?>">
            </td>
            <td style="width: 460px;">
                <h2 style="line-height: 0.01; font-size: 30px;">PT KAPSULINDO NUSANTARA</h2>
                <h3 style="line-height: 0.01; font-size: 23px;">Pedagang Besar Bahan Baku Farmasi</h3>
                <p style="line-height: 0.01;font-size: 12px;">Jl. Pancasila 1 Cicadas Gunung Putrri - Kab. Bogor 16964,
                    Indonesia</p>
                <p style="line-height: 0.01;font-size: 12px;">Tlp:(021) 8671165. Fax:(021) 8671168,86861734. Email:
                    pbbbf@kapsulindo.co.id</p>
            </td>
            <td style="padding-center:-10px; ">
                <?php $src = asset('img/logo/logo-penus2.png'); ?>
                <img style="width: 120px;height: 100px;" src="<?= $src ?>">
            </td>

        </tr>
    </table>

    <hr style="line-height: 0.01;">
    <div style="text-align: center;padding-top: 5px;">
        <h3 style="float: center;line-height: 0.2;">Laporan Stok Barang</h3>
    </div>


    <table style="width: 1000px;font-size: 18px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th class="text-right">Masuk</th>
                <th class="text-right">Keluar</th>
                <th class="text-right">Stok</th>
            </tr>
        </thead>
    </table> --}}
    <h1>Tes</h1>
</body>

</html>
