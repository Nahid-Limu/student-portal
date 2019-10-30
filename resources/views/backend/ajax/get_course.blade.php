<option value="">-- Select Department --</option>
    @foreach($course as $c)
        <option value="{{$c->id}}">{{$c->course_name}}</option>
    @endforeach