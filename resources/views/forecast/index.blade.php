@extends('layouts.main')
@section('title', 'Peramalan')
@section('content')

<div class="container-sm tabel_background">

<form id="forecastForm">
    @csrf
    <label for="alpha">Alpha:</label>
    <select name="alpha" id="alpha" class="form-control">
        <option value="0.1">0.1</option>
        <option value="0.2" selected>0.2</option>
        <option value="0.3">0.3</option>
    </select>

    <label for="kd_sparepart">Sparepart:</label>
    <select name="kd_sparepart" id="kd_sparepart" class="form-control">
        @foreach($kdSpareparts as $sparepart)
            <option value="{{ $sparepart->kd_sparepart }}">{{ $sparepart->nama_sparepart }}</option>
        @endforeach
    </select>
    

    <button type="button" onclick="hitungForecast()" class="btn btn-primary">Hitung</button>
</form>

<!-- Tambahkan container untuk hasil peramalan -->
<div id="forecastResults"></div>

<script>
    function hitungForecast() {
        var alpha = document.getElementById('alpha').value;
        var kdSparepart = document.getElementById('kd_sparepart').value;

        // Kirim permintaan Ajax ke endpoint forecast
        $.ajax({
            type: 'POST',
            url: '/forecast',
            data: {
                _token: '{{ csrf_token() }}',
                alpha: alpha,
                kd_sparepart: kdSparepart
            },
            success: function (data) {
                // Tampilkan hasil peramalan dalam container
                $('#forecastResults').html(data);
            }
        });
    }
</script>

</div>
@endsection