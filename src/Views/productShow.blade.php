@extends('layout')

@section('content')
    <section class="hero hero--360" style="background-image: url('/img/tmp/hero-home_2000x750.jpg')">
        <div class="table hero__table">
            <div class="table__cell table__cell--vtop">
                <div class="container">
                    {!! Breadcrumbs::render('site.hardware.product.details',  $product) !!}
                </div>
            </div>
        </div>
    </section>

    <main class="main--over-hero">

        <section>
            <div class="container">

                @include('partials.product-details__item', ['product' => $product])

            </div>
        </section>

        <section class="section--main pt--90">
            <div class="container">

                <div class="mw--1050">

                    @if(!empty($product['descriptions']['long_description_sliced']))
                        <div class="row">
                            @foreach ($product['descriptions']['long_description_sliced']['en'] as $idx => $description)
                                <div class="col-xs-12 col-sm-6">
                                    <div class="product-info">
                                        {!! $description !!}
                                    </div>
                                </div>
                                @if ($idx % 2 == 1)
                                    </div>
                                    <div class="row">
                                @endif
                            @endforeach
                        </div>
                    @endif

                    @if (!empty($product['files']['items']))
                        <div class="box box--left-gradient bg--white documents-box">
                            <div class="box__inner-content">
                                <h2 class="heading-line heading-2--big inline">Toolkit</h2>
    {{--                            <a href="#" class="btn btn--small btn--red documents-box__btn">
                                    <span>download all documents</span>
                                    <i class="icon-download icon--right" aria-hidden="true"></i>
                                </a>--}}
                                <div class="documents-box__files clearfix">
                                    @foreach($product['files']['items'] as $file)
                                    <a href="/documents/download/{{$file['id']}}" download="{{$file['name']}}" class="documents-box__file">
                                    <span class="documents-box__file-icon">
                                        <i class="icon-file icon" aria-hidden="true"></i>
                                    </span>
                                        <span class="documents-box__file-name">{{$file['name']}}</span>
                                        <span class="documents-box__file-type">{{$file['ext']}}</span>
                                    </a>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </section>
        <div class="related-list bg--white">
            @if(count($relatedCourses))
                <section class="section--main">
                    <div class="container">
                        <h3 class="text-center mb--70">
                            <span>Related Courses</span>
                        </h3>

                        @include('partials.components.related-courses__list')

                    </div>
                </section>
            @endif
            @if(count($relatedProducts))
                <section class="section--main">
                    <div class="container">
                        <h3 class="text-center mb--70">
                            <span>Related Hardware</span>
                        </h3>

                        @include('partials.related-products__list')

                    </div>
                </section>
            @endif
        </div>

    </main>
    <script type="text/javascript" src="/plugins/ecommerce/cart.js"></script>
@endsection