<html>
    
    
    {{ $periodo }}
    @foreach($reportes as $item)
       
            <tr>
                <td>{{ $item->fecha }}</td>
                <td>{{ $item->n_comp }}</td>
                <td>{{ $item->periodo }}</td>
            </tr>           
       
    @endforeach

</html>