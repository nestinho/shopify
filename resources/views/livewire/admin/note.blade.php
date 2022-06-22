<table class="table">
    @foreach($contacts as $contact)
        <tr>
            <th>Name</th>
            <td>{{$contact->name}}</td>
            <th>Email</th>
            <td>{{$contact->email}}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{$contact->phone}}</td>
            <th>Comment</th>
            <td>{{$contact->comment}}</td>
        </tr>
    @endforeach
</table>