<thead>
<tr><th></th>

    <th>Current Post Office</th>
    <th>Next Post Office</th>
    <th>Status</th>
    {{--<th></th>--}}



</tr>
</thead>
<tbody>
<?php $route= route('parcelDetails')?>
@foreach($entities as $entity)
    <tr data-id="{{$entity->id}}">

        <td></td>
        <?php $current =$entity->currentPostOffice()->first();?>
        <td>{{$current==null?"":$current->name}}</td>
        <?php $next =$entity->nextPostOffice()->first();?>
        <td>{{$next==null?"":$next->name}}</td>
        <td>{{$entity->statusObject()->first()->title}}</td>
        {{--<td style="max-width: 30px;cursor: pointer"><span><i class="material-icons">delete</i></span></td>--}}

    </tr>
@endforeach
</tbody>