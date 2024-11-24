<div>
    <li> 
        <a class="nav-link" href="{{route('shop')}}" style="font-weight: 700;">All Product </a>
    </li>

    @foreach($categories as $category)
        <li> 
            <a class="nav-link" style="font-weight: 700;">{{$category->name}}</a>
        </li>
    @endforeach
</div>
