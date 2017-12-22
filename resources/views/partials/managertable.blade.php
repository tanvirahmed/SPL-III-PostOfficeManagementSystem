<thead>
<tr><th></th>
    <th>Name</th>
    <th>NID</th>
    <th>Email</th>
    <th>Dob</th>
    <th>Branch</th>

</tr>
</thead>
<tbody>
@foreach($entities as $entity)
    <tr data-id="{{$entity->id}}">
        <td></td>
        <td>{{$entity->name}}</td>
        <td>{{$entity->nid}}</td>
        <td>{{$entity->email}}</td>
        <td>{{$entity->dob}}</td>

        <td>
            <?php $assignedBranch= $entity->assignedBranch()->first()?>
            {{($assignedBranch==null)?'Not Assigned':$assignedBranch->name}}
        </td>
    </tr>
@endforeach
</tbody>