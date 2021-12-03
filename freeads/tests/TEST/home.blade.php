@extends('layouts.app')
  
@section('content')
<div class="container row justify-content-center col-md-12">


                @foreach($advertising as $key => $data)
                    <tr>    
                    <th class= "col"><img width="140px" src="/picture/{{$data->picture}}" alt=""></th>
                    <th class="col">{{$data->title}}</th>
                    <th class="col">{{$data->category}}</th>
                    <th class="col">{{$data->description}}</th>
                    <th class="col">{{$data->price}}</th>  
                    <th class= "col">{{$data->location}}</th>               
                    </tr>
                @endforeach
               

</div>
@endsection