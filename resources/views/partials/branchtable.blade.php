<thead>
<tr><th></th>
    <th>Name</th>
    <th>Post Code</th>
    <th>Zilla</th>
    <th>Upzilla</th>
    <th>Manager</th>

</tr>
</thead>
<tbody>
@foreach($entities as $entity)
    <tr data-id="{{$entity->id}}">
        <td></td>
        <td>{{$entity->name}}</td>
        <td>{{$entity->post_code}}</td>
        <td>{{$entity->zilla}}</td>
        <td>{{$entity->upzilla}}</td>
        <?php  $manager = $entity->manager()->first()?>
        <td>{{$manager!=null?$manager->name:'Not assigned'}}</td>
    </tr>
@endforeach
</tbody>