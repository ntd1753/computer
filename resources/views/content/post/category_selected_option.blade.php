@foreach($categories as $category)
    @if($item->category_id === $category->id)
        <option value="{{$category->id}}" selected>{{str_repeat("----", $level).$category->name}}</option>
    @else
        <option value="{{$category->id}}">{{str_repeat("----", $level).$category->name}}</option>
    @endif
    @if($category->subCategories)
        @include('content.post.category_selected_option', ["categories" =>$category->subCategories, 'level' => $level+1, "item"=>$item])
    @endif
@endforeach
