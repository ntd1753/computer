@foreach($categories as $category)
    <option value="{{$category->id}}">{{str_repeat("----", $level).$category->name}}</option>
    @if($category->subCategories)
        @include('content.category.category_option', ["categories" =>$category->subCategories, 'level' => $level+1])
    @endif
@endforeach
