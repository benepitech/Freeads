@extends('layout')
     
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Manage my Ads') }}</div>
  
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif      
        
                      
                                    <div class="container row justify-content-center col-md-12">
                                            <br><br>
                                            @foreach($ads as $key => $data)
                                                <div class="grid-container">    
                                                    <div class="grid-item1"><img width="140px" height= "110px" src="/picture/{{$data->picture}}" alt=""></div>
                                                    <div class="grid-item2">{{$data->title}}</div>
                                                    <div class="grid-item3">{{$data->category}}</div>
                                                    <div class="grid-item4">{{$data->description}}</div>
                                                    <div class="grid-item5">{{$data->price}}$</div>  
                                                    <div class="grid-item6">{{$data->location}}</div>
                                                    <div class="grid-item7">{{$data->created_at}}</div>

                                                </div>
                                                <form action="{{ route('ads.destroy',$data->id) }}" method="POST">
     
                                                    <a class="btn btn-info" href="{{ route('show_my_ads',$data->id) }}">Show</a>

                                                    <a class="btn btn-primary" href="{{ route('ads.edit',$data->id) }}">Edit</a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            @endforeach
                                    </div>          
                        
                      
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
    
  
        
@endsection