@if($category->activeChildren->count())
    <span class="openSubPanel">
@endif

<a href="{{$category->activeChildren->count() ? '#' : route('category.show', ['slug' => $category->slug])  }}"> {{ $category->name }}
<!--@if($category->icon)-->
<!--  <span class="img-category">-->
<!--	  <img src="{{asset($category->icon)}}" alt="{{$category->name}}" class="img-fluid">-->
<!--  </span>-->
<!--  @endif-->
</a>
@if($category->activeChildren->count())
            <span class="arow-menu"><i class=""></i></span>
		</span>
    <ul class="subPanel">
        <li class="close-li">
			  <span class="closeSubPanel">
				  <i class=""></i> بازگشت </span>
        </li>
        @foreach($category->activeChildren as $categoryChild)
            <li class="main-menu">
                @include('frontend.layouts.partials.cat',['category' => $categoryChild])
            </li>
        @endforeach
       <li class="main-menu"> 
       <a href="{{ route('category.show', $category->slug) }}"> مشاهده تمام موارد {{ $category->name }}
       </a>
      </li>
    </ul>
@endif