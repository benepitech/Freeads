@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Administration interface for ads</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('ads.create') }}"> Create New ad</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>id</th>
            <th>user_id</th>
            <th>Picture</th>
            <th>Title</th>
            <th>Category</th>
            <th>Description</th>
            <th>Price</th>
            <th>Location</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($ads as $ad)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $ad->id }}</td>
            <td>{{ $ad->user_id }}</td>
            <td><img src="/picture/{{ $ad->picture }}" width="100px"></td>
            <td>{{ $ad->title }}</td>
            <td>{{ $ad->category }}</td>
            <td>{{ $ad->description }}</td>
            <td>{{ $ad->price }}</td>
            <td>{{ $ad->location }}</td>
            <td>
                <form action="{{ route('ads.destroy',$ad->id) }}" method="POST">
     
                    <a class="btn btn-info" href="{{ route('ads.show',$ad->id) }}">Show</a>
      
                    <a class="btn btn-primary" href="{{ route('ads.edit',$ad->id) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $ads->links() !!}
        
@endsection