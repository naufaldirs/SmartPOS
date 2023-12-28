<script>
   
</script>
<table class="table table-responsive">
    <thead>
        <tr>
            <th>No</th>
            <th>Periode</th>
            <th>Actual</th>
            <th>Forecast</th>
            <th>MAD</th>
            <th>MSE</th>
            <th>MAPE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($forecastResults as $result)
        <tr>
            <td>{{ $result->no }}</td>
            <td>{{ $result->periode }}</td>
            <td>{{ $result->actual }}</td>
            <td>{{ $result->forecast }}</td>
            <td>{{ $result->mad }}</td>
            <td>{{ $result->mse }}</td>
            <td>{{ $result->mape }}</td>
        </tr>
        @endforeach
    </tbody>

</table>