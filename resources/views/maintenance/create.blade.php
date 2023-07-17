@include('assets.head')

@section('content')
<div class="container">
    <h1>Create Barang</h1>
    <!--<form method="POST" action="{{ url('/containers') }}" enctype="multipart/form-data">-->
    <form action="{{ route('maintenance.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="part_id">Part</label>
            <select name="part_id" class="form-control" id="part_id">
                @foreach($parts as $part)
                <option value="{{ $part->id }}">
                    {{ $part->name }} <!-- use the first fillable attribute -->
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="vehicles_id">Lokasi ID:</label>
            <select id="vehicles_id" name="vehicles_id" class="form-control">
                @foreach($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}">
                    {{ $vehicle->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quality_id">Jenis Aset:</label>
            <select name="quality_id" class="form-control" id="quality_id">
                @foreach($qualities as $quality)
                <option value="{{ $quality->id }}">
                    {{ $quality->name }} <!-- use the first fillable attribute -->
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">description :</label>
            <input type="text" id="description" name="description" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="createdBy">createdBy :</label>
            <input type="text" id="createdBy" name="createdBy" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="file_image">Gambar Bukti :</label>
            <input type="fole" id="file_image" name="file_image" class="form-control-file" accept="image/*" enctype="multipart/form-data" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>

</script>
@endsection