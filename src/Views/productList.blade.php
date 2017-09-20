@extends('layout')

@section('content')
    <section class="hero" style="background-image: url('/img/tmp/hero-home_2000x750.jpg')">
        <div class="table hero__table">
            <div class="table__cell table__cell--vmiddle">
                <div class="container">
                    <h1 class="hero__title">
                        Hardware
                    </h1>
                    <h2 class="text--blue">Get the tools. Expand your services. Help your patients.</h2>
                    <p>
                        Corozon Hardware offers high quality testing and screening products for point of care tests to detect disease, educate your patients and provide more informed physician recommendations. To master the use of our products, take our corresponding Corozon Academy courses.
                    </p>

                    <a href="#product-list" class="btn btn--big btn--red btn--270">
                        <span>Browse products</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <main>
        {!! Breadcrumbs::render('site.hardware.product.list') !!}

        @include('partials.components.list-hardware-filter')

        @include('partials.product-list')

    </main>
    <script type="text/javascript" src="/plugins/ecommerce/cart.js"></script>
@endsection