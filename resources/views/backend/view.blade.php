
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>CODE</th>
            <th>TIME</th>
            <th>IP</th>
            <th>BROWSER</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
    <tr>
        <td>{{@$d->links->code}}</td>
        <td>{{$d->time}}</td>
        <td>{{$d->ip}}</td>
        <td>{{$d->browser}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
