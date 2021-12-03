@extends('layout')
  
@section('content')





    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome to FreeAds {{ Auth::user()->username }}</div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
  
                    @can('isAdmin')
                        <div class="btn btn-success btn-lg">
                          You have Admin Access
                        </div>
                    
                    @else

                    @endcan
            <h3>Filter by</h3>
                <form method="GET">
                    <div class="dropdown" id="sample-table-3">
                        <label></label>
                        <select class= "m-2 btn btn-secondary dropdown-toggle" name="category_id" id="category_id">
                            <option value="0">Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                            </select>
                    </div>
                </form>

                <form method="GET">
                    <div class="dropdown" id="sample-table-3">
                        <label></label>
                        <select class= "m-2 btn btn-secondary dropdown-toggle "name="location_id" id="location_id">
                            <option value="0">Locations</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->name }}">{{ $location->name }}</option>
                                    @endforeach
                            </select>
                    </div>
                </form>
                

                <div class="input-group rounded">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                    aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                            <i class="fas fa-search"></i>
                </span>
                </div>




                    <div class="container row justify-content-center col-md-12">
                    {{ $advertising ?? ''->links() }} <br><br>
                        @foreach($advertising ?? '' as $key => $data)

                            <div class = "grid-container container">    
                            <div class= "grid-item1 col-md-"><img size= "100%" width="140px" height= "110px" src="/picture/{{$data->picture}}" alt=""></div>
                            <div class="grid-item2 col-md-">{{$data->title}}</div>
                            <div class="grid-item3 col-md-">{{$data->location}}</div>
                            <div class="grid-item4 col-md-">{{$data->description}}</div>
                            <div class="grid-item5 col-md-">{{$data->price}}$</div>  
                            <div class= "grid-item6 col-md-">{{$data->created_at}}</div>    
             
                            </div>
                            <a class="btn btn-primary" href="{{ route('user_show_ad',$data->id) }}">Click here to see the Ad</a>
                      
                        @endforeach
                    </div>  
                             
                </div>
             
            </div>
             
        </div>
    </div>

@endsection