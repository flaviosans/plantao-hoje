<div>
    Nome: {{$pedido->item}}
</div>
<table>
    @foreach($pedido->item as $cada)
    <tr>
        <td>{{$cada->nome}}</td>
    </tr>
    @endforeach
</table>