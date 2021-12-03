

<div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" value="">Show all</button>
        <ul class="dropdown-menu" role="menu">
            @foreach ($categories as $category)
            @if($category->id == Input::get('category')
               <li value="{{ $category->id }}"><a href="{{$category->id}}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
     </div>

     @foreach ($categories as $category)
    @if($category->id == Input::get('category')
           // echo category as selected
    @else
           // echo category
    @endif
@endforeach