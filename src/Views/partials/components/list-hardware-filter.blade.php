<form method="post" action="{{ route($filterRoute) }}" class="form form--default" id="hardwareFilterForm">
    {!! csrf_field() !!}
    <input type="hidden" name="productFilter" value="1" />
    <div class="list-filter-wrapper list-filter-wrapper--top">
        <div class="container box__text-content">
            <select class="js-selectboxit custom-select" id="filterCategory" name="filterCategory">
                <option value="0" @if($catId) selected @endif>All categories</option>
                @foreach($categories as $category)
                    <option value="{{$category['id']}}" @if($category['id'] == $catId) selected @endif>{{$category['name']}}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

@if($catLead)
    <div class="container" style="text-align: center;">
        <h2>{{$catLead['lead']}}</h2>
    </div>
@endif

<script>
    $(function() {
        $('#filterCategory').on('change', function() {
            $('#hardwareFilterForm').submit();
        });
    });
</script>

@if($needScroll)
<script>
    $(function() {
        $('html,body').animate({
                scrollTop: $("#product-list").offset().top},
            'slow');
    });
</script>
@endif