<div class="related-products-list">
    @php
        $count = count($relatedProducts);
    @endphp
    @for ($i = 0; $i < $count; $i += 2)
        <div class="row row--30">
            <div class="table table--border-spacing table--main h--100">
                @if(!empty($relatedProducts[$i]))
                <div class="col-xs-12 col-lg-6 table__cell table__cell--vtop h--100">
                    <div class="table h--100">
                        @if(!empty($relatedProducts[$i]['gallery']['items'][0]['thumbnails'][1]['path']))
                            <div class="table__cell table__cell--vtop h--100 col-xs-12 col-sm-6 box__img-content" style="background-image: url('/{{ $relatedProducts[$i]['gallery']['items'][0]['thumbnails'][1]['path'] }}')">
                                <img src="/{{ $relatedProducts[$i]['gallery']['items'][0]['thumbnails'][1]['path'] }}" alt="{{ $relatedProducts[$i]['name']['en'] }}" class="visible-xs">
                            </div>
                        @else
                            <div class="table__cell table__cell--vtop h--100 col-xs-12 col-sm-6 box__img-content" style="background-image: url('/img/tmp/top-products-1_375x400.jpg')">
                                <img src="/img/tmp/top-products-1_375x400.jpg" alt="{{ $relatedProducts[$i]['name']['en'] }}" class="visible-xs">
                            </div>
                        @endif
                        <div class="table__cell table__cell--vtop h--100 col-xs-12 col-sm-6 box__text-content bg--lightgray">
                            <div class="table h--100 box">
                                <div class="table__row h--100">
                                    <div class="table__cell table__cell--vtop box__inner-content">
                                        <span class="box__category box__category--small">{{ $relatedProducts[$i]['category']['name'] }}</span>
                                        <h3 class="heading-line heading-3--big">{{ $relatedProducts[$i]['name']['en'] }}</h3>
                                        <p>{{ $relatedProducts[$i]['descriptions']['short_description']['en'] }}</p>
                                    </div>
                                </div>
                                <div class="table__row">
                                    <div class="table__cell table__cell--vtop box__buttons">
                                        <div class="table">
                                            <div class="table__cell table__cell--vmiddle w--100">
                                                @if( !empty(Auth::user()->name) )
                                                    <b class="box__price box__price--small">
                                                        {{ formatPrice($relatedProducts[$i]['price']) }}
                                                    </b>
                                                @else
                                                    <b class="box__price-text">
                                                        Sign in to view price
                                                    </b>
                                                @endif
                                            </div>
                                            <div class="table__cell table__cell--vmiddle">
                                                <a href="{{ route('site.hardware.product.details', ['id' => $relatedProducts[$i]['id'], 'slug' => $relatedProducts[$i]['slug']]) }}" class="btn btn--small btn--blue">
                                                    <span>buy now</span>
                                                    <i class="fa fa-shopping-cart icon icon--right" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(!empty($relatedProducts[$i+1]))
                <div class="col-xs-12 col-lg-6 table__cell table__cell--vtop h--100">
                            <div class="table h--100">
                                @if(!empty($relatedProducts[$i+1]['gallery']['items'][0]['thumbnails'][1]['path']))
                                    <div class="table__cell table__cell--vtop h--100 col-xs-12 col-sm-6 box__img-content" style="background-image: url('/{{ $relatedProducts[$i+1]['gallery']['items'][0]['thumbnails'][1]['path'] }}')">
                                        <img src="/{{ $relatedProducts[$i+1]['gallery']['items'][0]['thumbnails'][1]['path'] }}" alt="{{ $relatedProducts[$i+1]['name']['en'] }}" class="visible-xs">
                                    </div>
                                @else
                                    <div class="table__cell table__cell--vtop h--100 col-xs-12 col-sm-6 box__img-content" style="background-image: url('/img/tmp/top-products-1_375x400.jpg')">
                                        <img src="/img/tmp/top-products-1_375x400.jpg" alt="{{ $relatedProducts[$i+1]['name']['en'] }}" class="visible-xs">
                                    </div>
                                @endif
                                <div class="table__cell table__cell--vtop h--100 col-xs-12 col-sm-6 box__text-content bg--lightgray">
                                    <div class="table h--100 box">
                                        <div class="table__row h--100">
                                            <div class="table__cell table__cell--vtop box__inner-content">
                                                <span class="box__category box__category--small">{{ $relatedProducts[$i+1]['category']['name'] }}</span>
                                                <h3 class="heading-line heading-3--big">{{ $relatedProducts[$i+1]['name']['en'] }}</h3>
                                                <p>{{ $relatedProducts[$i+1]['descriptions']['short_description']['en'] }}</p>
                                            </div>
                                        </div>
                                        <div class="table__row">
                                            <div class="table__cell table__cell--vtop box__buttons">
                                                <div class="table">
                                                    <div class="table__cell table__cell--vmiddle w--100">
                                                        @if( !empty(Auth::user()->name) )
                                                            <b class="box__price box__price--small">
                                                                {{ formatPrice($relatedProducts[$i+1]['price']) }}
                                                            </b>
                                                        @else
                                                            <b class="box__price-text">
                                                                Sign in to view price
                                                            </b>
                                                        @endif
                                                    </div>
                                                    <div class="table__cell table__cell--vmiddle">
                                                        <a href="{{ route('site.hardware.product.details', ['id' => $relatedProducts[$i+1]['id'], 'slug' => $relatedProducts[$i+1]['slug']]) }}" class="btn btn--small btn--blue">
                                                            <span>buy now</span>
                                                            <i class="fa fa-shopping-cart icon icon--right" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
            </div>
        </div>
    @endfor


    <div class="text-center">
        <a href="{{ route('site.hardware.product.list') }}" class="btn btn--big btn--blue btn--340 btn--section">
            <span>Check out the full list of products </span>
        </a>
    </div>
</div>