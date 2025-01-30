<div>
    <h1>Liste cours</h1>
    @foreach($cours as $cour)
    <hr>
    <h1> {{$loop->index}} Liste cours</h1>
    <h1>{{$cour->libeller}}</h1>
    <h1>{{$cour->module_id}}</h1>
    <p>{{$cour->desc}}</p>
    <hr>
    @endforeach
</div>