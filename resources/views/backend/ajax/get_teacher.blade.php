<option value="">-- Select Teacher --</option>
    @foreach($teacher as $t)
        <option value="{{$t->id}}">{{$t->name}}</option>
    @endforeach