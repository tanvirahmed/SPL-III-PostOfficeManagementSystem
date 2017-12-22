<thead>
<tr><th></th>
    <th>Sender Name</th>
    <th>Receiver Name</th>
    <th>S. Post Office</th>
    <th>C. Post Office</th>
    <th>D. Post Office</th>
    <th>Status</th>
    @if($type==2)
    <th>Money</th>
        @else
        <th>Weight</th>
    @endif

    <th>Time</th>
    <th>TID</th>
    <th style="max-width: 30px"></th>

</tr>
</thead>
<tbody>
<?php $route= route('parcelDetails')?>
@foreach($entities as $entity)
    <tr data-id="{{$entity->id}}">

        <td></td>

        <td>{{$entity->sender_name}}</td>
        <td>{{$entity->receiver_name}}</td>
        <td>{{$entity->sourcePostOffice()->first()->name}}</td>
        <td>
            <?php  $current = $entity->currentPostOffice()->first()?>
            {{$current!=null?$current->name:'Pending'}}
        </td>
        <td>{{$entity->destinationPostOffice()->first()->name}}</td>
        <td>
            <?php $status =$entity->statusObject()->first()?>
            {{$status!=null?$status->title:'Pending'}}
        </td>
        <td>
            {{$entity->weight}}@if($type==1) kg @endif
        </td>
        <td>
            {{date('d F Y h:i',strtotime($entity->created_at))}}
        </td>
        <td>
            {{$entity->tracking_id}}
        </td>
        <td style="max-width: 30px;cursor: pointer" ><a href="{{$route."/".$entity->id}}"><i class="material-icons">arrow_forward</i></a></td>
    </tr>
@endforeach
</tbody>