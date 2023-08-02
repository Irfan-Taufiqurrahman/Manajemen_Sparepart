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
    <div style="width: 50%; float: left; vertical-align: middle;">
        Report Part
    </div>
</div>

<table style="position: relative; top: 50px;">
    <thead>
        <tr>
            <th>Gambar Bukti</th>
            <th>Kendaraan</th>
            <th>Part</th>
            <th>Quality</th>
            <th>Deskripsi</th>
            <th>Dibuat Oleh</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td data-column="Gambar">
                <img src="{{ public_path('storage/foto_kondisi/' . $item->file_image) }}" style=" width: 100px; height: 100px;" alt="">
                <!--{{ $item->file_image }}-->
            </td>
            <td data-column="Kendaraan">{{ $item->show_vehicle->name }}</td>
            <td data-column="Part">{{ $item->show_part->name }}</td>
            <td data-column="Kualitas">{{ $item->show_quality->name }}</td>
            <td data-column="deskripsi">{{ $item->description }}</td>
            <td data-column="dibuat oleh">{{ $item->createdBy }}</td>
            <td data-column="Tanggal"> {{ date('F j, Y', strtotime($item->tanggal)) }}</td>
            </td>
        </tr>
        @endforeach
        <!-- Add more rows if needed -->
    </tbody>
</table>