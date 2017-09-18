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
                <h2><a href="{{ route('site.hardware.product.details', ['id' => $product['id']]) }}" class="link--purple">{{$product['name']['en']}}</a></h2>
                @if(!empty($product['descriptions']['short_description']))
                    <p>{{ $product['descriptions']['short_description']['en'] }}</p>
                @endif
                <p><a href="{{ route('site.hardware.product.details', ['id' => $product['id']]) }}" class="btn btn--small btn--blue" role="button"><span>More</span></a></p>
            </div>
            <div class="box__buttons">
                <div class="table">
                    @if( empty(Auth::user()->name) )
                    <div class="table__cell table__cell--vmiddle w--100">
                        <b class="box__price-text">
                            Please sign in to view the price
                        </b>
                    </div>
                    @else
                    <div class="table__cell table__cell--vmiddle w--100">
                        <b class="box__price box__price--small">
                            @if (Auth::check() == true && $product['price']) {{ formatPrice($product['price']) }}  @endif
                        </b>
                    </div>
                    <div class="table__cell table__cell--vmiddle text-nowrap">
                        <input type="number" name="{{$product['id']}}" value="{!! (!empty(\Session::get('cart')[$product['id']])) ? \Session::get('cart')[$product['id']] : 1 !!}" class="form-control form-control--small form-control--qty productNumber">
                        <a href="#" class="btn btn--small btn--red change-cart">
                            <span>buy now</span>
                            <i class="icon-cart icon--right" aria-hidden="true"></i>
                            {{-- <button class="btn btn-primary btn-sm add-to-cart" data-product-id="{{$product['id']}}" data-is-singleton="{{$product['is_singleton']}}"><span class="glyphicon glyphicon-shopping-cart"></span></button>--}}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>