@extends('layout')

@section('content')
    <section class="hero" style="background-image: url('/img/tmp/hero-home_2000x750.jpg')">
        <div class="table hero__table">
            <div class="table__cell table__cell--vmiddle">
                <div class="container">
                    <h1 class="hero__title">
                        Academy
                    </h1>
                    <h2 class="text--blue">Get the knowledge. Put it into action. Grow your practice.</h2>
                    <p>
                        Corozon Academy is not your average therapeutic education system for pharmacists. Delivered by clinical experts and other healthcare professionals our courses provide practical information that helps effectively develop and grow your pharmaceutical practice.
                    </p>

                    <a href="#" class="btn btn--big btn--red btn--270">
                        <span>Discover Our Courses</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <main>
        {{--@include('_sitebuild.partials.components.breadcrumb')--}}

        {{--@include('_sitebuild.partials.components.list-filter')--}}

        @include('partials.product-list')

    </main>
    <script type="text/javascript" src="/plugins/ecommerce/cart.js"></script>
@endsection