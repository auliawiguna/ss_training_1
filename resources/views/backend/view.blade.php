
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>TIME</th>
            <th>IP</th>
            <th>BROWSER</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $data = \DB::table('link_stats')->where('link_id',$id)->get();
    ?>
    @foreach($data as $d)
    <tr>
        <td>{{$d->ip}}</td>
        <td>{{$d->browser}}</td>
        <td>{{$d->time}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
