@extends('layout')

@section('content')
    <section class="hero hero--360" style="background-image: url('/img/tmp/hero-home_2000x750.jpg')">
        <div class="table hero__table">
            <div class="table__cell table__cell--vtop">
                <div class="container">
                    {{--@include('_sitebuild.partials.components.breadcrumb')--}}
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

                    {{-- TODO @David IDŐSZAKOSAN KIVÉVE AMÍG NINCSENEK FILEOK --}}
{{--                    <div class="box box--left-gradient bg--white documents-box">
                        <div class="box__inner-content">
                            <h2 class="heading-line heading-2--big inline">Documents</h2>
                            <a href="#" class="btn btn--small btn--red documents-box__btn">
                                <span>download all documents</span>
                                <i class="icon-download icon--right" aria-hidden="true"></i>
                            </a>
                            <div class="documents-box__files clearfix">

                                <a href="/documents/lorem.pdf" download="Background Information" class="documents-box__file">
                                <span class="documents-box__file-icon">
                                    <i class="icon-file icon" aria-hidden="true"></i>
                                </span>
                                    <span class="documents-box__file-name">Background Information</span>
                                    <span class="documents-box__file-type">PDF</span>
                                </a>

                                <a href="/documents/lorem.pdf" download="User Manual" class="documents-box__file">
                                <span class="documents-box__file-icon">
                                    <i class="icon-file icon" aria-hidden="true"></i>
                                </span>
                                    <span class="documents-box__file-name">User Manual</span>
                                    <span class="documents-box__file-type">PDF</span>
                                </a>

                            </div>
                        </div>
                    </div>--}}

                </div>

            </div>
        </section>

        <section class="section--main bg--white pt--90">
            <div class="container">

                <h3 class="text-center mb--70">
                    <span>Corozon Academy</span>
                    <span class="text--light-italic">/ Top courses</span>
                </h3>

                @include('partials.components.related-courses__list')

            </div>
        </section>

    </main>
    <script type="text/javascript" src="/plugins/ecommerce/cart.js"></script>
@endsection