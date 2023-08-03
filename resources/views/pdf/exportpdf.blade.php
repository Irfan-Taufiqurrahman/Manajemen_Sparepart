<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 50px auto;
    }

    /* Zebra Stripping */
    tr:nth-of-type(odd) {
        background: #eee;
    }

    th {
        background: #3498db;
        color: white;
        font-weight: bold;
    }

    td[data-column="Gambar"] {
        width: 30px;
        height: 30px;
    }

    td[data-column="Gambar"] img {
        display: block;
        margin: 0 auto;
    }

    td,
    th {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: center;
        vertical-align: middle;
        font-size: 18px;
    }

    /* Responsive CSS */
    @media (max-width: 768px) {
        table {
            font-size: 14px;
        }

        th,
        td {
            padding: 5px;
        }
    }
</style>

<div style="width: 95%; margin: 0 auto;">
    <div style="width: 10%; float: left; margin-right: 20px;">
        <img src="img/Logo_PT.png" width="100%" alt="">
    </div>
    <div style="width: 50%; float: left; vertical-align: middle; font-family: 'Roboto', sans-serif;">
        <div style="font-size: xx-large;">
            Report Part
        </div>
        <div>
            @if($from && $to) range tanggal : {{ $from }} hingga {{ $to }} @endif
        </div>

    </div>
</div>

<table style="position: relative; top: 50px;">
    <thead>
        <tr>
            <th>Gambar Bukti</th>
            <th>Kendaraan</th>
            <th>Part</th>
            <th>Kilometer</th>
            <th>Deskripsi</th>
            <th>Di Input Oleh</th>
            <th>Tanggal</th>
            <th>status service</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td data-column="Gambar">
                <img src="{{ public_path('storage/foto_kondisi/' . $item->image) }}" style=" width: 100px; height: 100px;" alt="">
                <!--{{ $item->file_image }}-->
            </td>
            <td data-column="Kendaraan">{{ $item->show_vehicle->name }}</td>
            <td data-column="Part">{{ $item->show_part->name ?? 'Oli' }}</td>
            <td data-column="Kilometer">{{ $item->number ? number_format($item->number) . ' Kilometer' : '-' }}</td>
            <td data-column="deskripsi">{{ $item->description ?? '-' }}</td>
            <td data-column="diinput oleh">{{ $item->createdBy }}</td>
            <td data-column="Tanggal"> {{ date('j F, Y', strtotime($item->tanggal)) }}</td>
            <td data-column="status service">{{ $item->status_service }}</td>
            </td>
        </tr>
        @endforeach
        <!-- Add more rows if needed -->
    </tbody>
</table>