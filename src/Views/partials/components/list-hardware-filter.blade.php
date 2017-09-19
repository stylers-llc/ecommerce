<form method="post" action="{{ route('product.filter') }}" class="form form--default">
    {!! csrf_field() !!}
    <input type="hidden" name="productFilter" value="1" />
    <div class="list-filter-wrapper list-filter-wrapper--top">
        <div class="container box__text-content">
            <select class="js-selectboxit custom-select" id="filterCategory" name="filterCategory">
                @foreach($categories as $category)
                    <option value="{{$category['id']}}" @if($category['id'] == $catId) selected @endif>{{$category['name']}}</option>
                @endforeach
            </select>

            <input type="submit" class="btn btn--big btn--red" value="Filter results">
        </div>
    </div>
</form>