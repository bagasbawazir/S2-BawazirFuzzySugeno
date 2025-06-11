<div>
    @foreach ($this->stock_report as $key => $value)
    <tr>

        <td>{{ $value['id_inggridient'] }}</td>
        <td>{{ $value['name_inggridient'] }} ({{ $value['unit_inggridient'] }})</td>
        <td>{{ $value['stock'] }}</td>
        <td>{{ $value['purchase'] }}</td>
        <td>{{ $value['stock_in'] }}</td>
        <td>{{ $value['stock_out'] }}</td>
        <td>{{ $value['last_stock'] }}</td>
    </tr>
    @endforeach
</div>
