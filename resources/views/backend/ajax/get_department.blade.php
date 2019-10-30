<option value="">-- Select Department --</option>
    @foreach($department as $d)
        <option value="{{$d->id}}">{{$d->department_name}}</option>
    @endforeach