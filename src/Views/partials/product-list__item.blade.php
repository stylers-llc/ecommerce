<div class="row course-list__item">
    <div class="col-xs-12 col-sm-6 box__img-content">
        <div class="js-slick-slider">
            @if (!empty($product['gallery']['items']))
                @foreach($product['gallery']['items'] as $picture)
                    <div class="course-list__img" style="background-image: url('/{{$picture['path']}}')">
                        <img src="/{{$picture['path']}}" alt="Ut wisi enim ad minim veniam, quis nostrud exercitation" class="visible-xs">
                    </div>
                @endforeach
            @endif

        </div>
    </div>
    <div class="col-xs-12 col-sm-6 box__text-content">
        <div class="box box--left-gradient bg--white">
            <div class="box__inner-content">
                <span class="box__category">{{$product['category']}}</span>
                <h1>{{$product['name']['en']}}</h1>
                @if(!empty($product['descriptions']['short_description']))
                    <p>{{ $product['descriptions']['short_description']['en'] }}</p>
                @endif
                <p><a href="{{ url('ecommerce/product/show', $product['id']) }}" class="btn btn-primary" role="button">More</a></p>
            </div>
            <div class="box__buttons">
                <div class="table">
                    @if( empty(Auth::user()->name) )
                    <div class="table__cell table__cell--vmiddle w--100">
                        <b class="box__price-text">
                            Please sign in to <br> view the price
                        </b>
                    </div>
                    @else
                    <div class="table__cell table__cell--vmiddle w--100">
                        <b class="box__price box__price--small">
                            {{ $product['price'] }} $
                        </b>
                    </div>
                    <div class="table__cell table__cell--vmiddle text-nowrap">
                        <input type="text" name="" value="1" class="form-control form-control--small form-control--qty">
                        <a href="#" class="btn btn--small btn--red">
                            <span>buy now</span>
                            <i class="icon-cart icon--right" aria-hidden="true"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>