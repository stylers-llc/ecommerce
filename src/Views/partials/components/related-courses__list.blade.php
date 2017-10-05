<div class="related-products-list">
    @php
        $count = count($relatedCourses);
    @endphp
    @for ($i = 0; $i < $count; $i += 2)
        <div class="row row--30">
            <div class="table table--border-spacing table--main h--100">
                @if(!empty($relatedCourses[$i]))
                    <div class="col-xs-12 col-lg-6 table__cell table__cell--vtop h--100">
                        <div class="table h--100">
                            <div class="table__cell table__cell--vtop h--100 col-xs-12 col-sm-6 box__img-content" style="background-image: url('/{{ $relatedCourses[$i]['gallery']['items'][0]['path'] }}')">
                                <img src="{{ $relatedCourses[$i]['gallery']['items'][0]['path'] }}" alt="{{ $relatedCourses[$i]['course']['name'] }}" class="visible-xs">
                            </div>
                            <div class="table__cell table__cell--vtop h--100 col-xs-12 col-sm-6 box__text-content bg--lightgray">
                                <div class="table h--100 box">
                                    <div class="table__row h--100">
                                        <div class="table__cell table__cell--vtop box__inner-content">
                                            <span class="box__category box__category--small">{{ $relatedCourses[$i]['course']['category']['name'] }}</span>
                                            <h3 class="heading-line heading-3--big"><a href="{{ route('site.academy.course.details', ['slug' => $relatedCourses[$i]['course']['slug']]) }}" class="link--purple">{{ $relatedCourses[$i]['course']['name'] }}</a></h3>
                                            <p>{!!  $relatedCourses[$i]['course']['short_description'] !!}</p>
                                        </div>
                                    </div>
                                    <div class="table__row">
                                        <div class="table__cell table__cell--vtop box__buttons">
                                            @if ($relatedCourses[$i]['course']['purchased'] === false)
                                                <div class="table">
                                                    <div class="table__cell table__cell--vmiddle w--100">
                                                        @if ($relatedCourses[$i]['course']['showPrice'])
                                                            <b class="box__price box__price--small"> {{ formatPrice($relatedCourses[$i]['price']) }}</b>
                                                        @else
                                                            <b class="box__price-text">
                                                                Sign in to view price
                                                            </b>
                                                        @endif
                                                    </div>

                                                    @if ($relatedCourses[$i]['course']['showPrice'])
                                                        <div class="table__cell table__cell--vmiddle">
                                                            <a href="#" class="btn btn--small btn--blue">
                                                                <span>buy now</span>
                                                                <i class="icon-cart icon--right" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <hr />
                                            @endif
                                            <div>
                                                <!-- .collapse-course-1 az elso elemnel, collapse-course-2 a masodik elemnel es igy tovabb... -->
                                                <a role="button" data-toggle="collapse" href=".collapse-course-{{$i + 1}}" aria-expanded="false" aria-controls="collapse-course-{{$i + 1}}" class="link link--purple link--toggle">
                                                    <span>List of lessons</span>
                                                    <i class="icon-arrowdown icon--right" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- .collapse-course-1 az elso elemnel, collapse-course-2 a masodik elemnel es igy tovabb... -->
                        <div class="hidden-lg">
                            <div class="collapse box__collapse collapse-course-{{$i + 1}}">
                                <div class="box__collapse-inner-content">
                                    <div class="lesson-list counter-block">

                                    @if ($relatedCourses[$i]['course']['hasDemoVideo'])
                                        <!-- start item -->
                                            <div class="lesson-list__item">
                                                <h3 class="counter-block__item lesson-list__title heading-3--small">
                                                    Demo video
                                                </h3>
                                                <div class="lesson-list__info">
                                                    <video controls>
                                                        <source src="{{ route('site.course.demo', [$relatedCourses[$i]['course']['id'], $relatedCourses[$i]['course']['videoId']]) }}" type='video/mp4'>
                                                    </video>
                                                </div>
                                            </div>
                                            <!-- end item -->
                                    @endif

                                    @foreach ($relatedCourses[$i]['course']['lessons'] as $lesson)

                                        <!-- start item -->
                                            <div class="lesson-list__item">
                                                <h3 class="counter-block__item lesson-list__title heading-3--small">
                                                    {{ $lesson->title }}
                                                </h3>
                                                {!! $lesson->desc !!}
                                                <div class="lesson-list__info">
                                                    {{--
                                                    <span class="lesson-list__time">
                                                        <i class="icon-time icon--left" aria-hidden="true"></i>
                                                        <b>14:28</b>
                                                    </span>
                                                    --}}
                                                    <span class="lesson-list__type">
                                                <i class="icon-play icon--left" aria-hidden="true"></i>
                                                <b>{{$lesson->lessontype->name}}</b>
                                            </span>
                                                </div>
                                            </div>
                                            <!-- end item -->

                                        @endforeach

                                    </div>
                                    <div class="box__collapse-close">
                                        <!-- .collapse-course-1 az elso elemnel, collapse-course-2 a masodik elemnel es igy tovabb... -->
                                        <a role="button" data-toggle="collapse" href=".collapse-course-{{$i + 1}}" aria-expanded="false" aria-controls="collapse-course-{{$i + 1}}"  class="link link--purple link--toggle link--toggle-close">
                                            <span>Close</span>
                                            <i class="icon-times icon icon--right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!empty($relatedCourses[$i+1]))
                    <div class="col-xs-12 col-lg-6 table__cell table__cell--vtop h--100">
                        <div class="table h--100">
                            <div class="table__cell table__cell--vtop h--100 col-xs-12 col-sm-6 box__img-content" style="background-image: url('/{{$relatedCourses[$i+1]['gallery']['items'][0]['path']}}')">
                                <img src="{{ $relatedCourses[$i+1]['gallery']['items'][0]['path'] }}" alt="{{ $relatedCourses[$i+1]['course']['name'] }}" class="visible-xs">
                            </div>
                            <div class="table__cell table__cell--vtop h--100 col-xs-12 col-sm-6 box__text-content bg--lightgray">
                                <div class="table h--100 box">
                                    <div class="table__row h--100">
                                        <div class="table__cell table__cell--vtop box__inner-content">
                                            <span class="box__category box__category--small">{{ $relatedCourses[$i+1]['course']['category']['name'] }}</span>
                                            <h3 class="heading-line heading-3--big"><a href="{{ route('site.academy.course.details', ['slug' => $relatedCourses[$i+1]['course']['slug']]) }}" class="link--purple">{{ $relatedCourses[$i+1]['course']['name'] }}</a></h3>
                                            <p>{!!  $relatedCourses[$i+1]['course']['short_description'] !!}</p>
                                        </div>
                                    </div>
                                    <div class="table__row">
                                        <div class="table__cell table__cell--vtop box__buttons">
                                            @if ($relatedCourses[$i+1]['course']['purchased'] === false)
                                                <div class="table">
                                                    <div class="table__cell table__cell--vmiddle w--100">
                                                        @if ($relatedCourses[$i+1]['course']['showPrice'])
                                                            <b class="box__price box__price--small">{{ formatPrice($relatedCourses[$i+1]['price']) }}</b>
                                                        @else
                                                            <b class="box__price-text">
                                                                Sign in to view price
                                                            </b>
                                                        @endif
                                                    </div>

                                                    @if ($relatedCourses[$i+1]['course']['showPrice'])
                                                        <div class="table__cell table__cell--vmiddle">
                                                            <a href="#" class="btn btn--small btn--blue">
                                                                <span>buy now</span>
                                                                <i class="icon-cart icon--right" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <hr />
                                            @endif
                                            <div>
                                                <!-- .collapse-course-1 az elso elemnel, collapse-course-2 a masodik elemnel es igy tovabb... -->
                                                <a role="button" data-toggle="collapse" href=".collapse-course-{{$i+2}}" aria-expanded="false" aria-controls="collapse-course-{{$i+2}}" class="link link--purple link--toggle">
                                                    <span>List of Lessons</span>
                                                    <i class="icon-arrowdown icon--right" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- .collapse-course-1 az elso elemnel, collapse-course-2 a masodik elemnel es igy tovabb... -->
                        <div class="hidden-lg">
                            <div class="collapse box__collapse collapse-course-{{$i+2}}">
                                <div class="box__collapse-inner-content">
                                    <div class="lesson-list counter-block">

                                    @if ($relatedCourses[$i+1]['course']['hasDemoVideo'])
                                        <!-- start item -->
                                            <div class="lesson-list__item">
                                                <h3 class="counter-block__item lesson-list__title heading-3--small">
                                                    Demo video
                                                </h3>
                                                <div class="lesson-list__info">
                                                    <video controls>
                                                        <source src="{{ route('site.course.demo', [$relatedCourses[$i+1]['course']['id'], $relatedCourses[$i+1]['course']['videoId']]) }}" type='video/mp4'>
                                                    </video>
                                                </div>
                                            </div>
                                            <!-- end item -->
                                    @endif

                                    @foreach ($relatedCourses[$i+1]['course']['lessons'] as $lesson)

                                        <!-- start item -->
                                            <div class="lesson-list__item">
                                                <h3 class="counter-block__item lesson-list__title heading-3--small">
                                                    {{ $lesson->title }}
                                                </h3>
                                                {!! $lesson->desc !!}
                                                <div class="lesson-list__info">
                                                    {{--
                                                    <span class="lesson-list__time">
                                                        <i class="icon-time icon--left" aria-hidden="true"></i>
                                                        <b>14:28</b>
                                                    </span>
                                                    --}}
                                                    <span class="lesson-list__type">
                                                <i class="icon-play icon--left" aria-hidden="true"></i>
                                                <b>{{$lesson->lessontype->name}}</b>
                                            </span>
                                                </div>
                                            </div>
                                            <!-- end item -->

                                        @endforeach

                                    </div>
                                    <div class="box__collapse-close">
                                        <!-- .collapse-course-1 az elso elemnel, collapse-course-2 a masodik elemnel es igy tovabb... -->
                                        <a role="button" data-toggle="collapse" href=".collapse-course-{{$i+2}}" aria-expanded="false" aria-controls="collapse-course-{{$i+2}}"  class="link link--purple link--toggle link--toggle-close">
                                            <span>Close</span>
                                            <i class="icon-times icon icon--right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                            <div class="col-xs-12 col-lg-6 table__cell table__cell--vtop h--100">
                                &nbsp;
                            </div>
                @endif
            </div>
        </div>
    @endfor
    <div class="row visible-lg">
        <div class="related-products-list__collapse-contents">
            <div class="clearfix">
                @if(!empty($relatedCourses[0]))
                    <div class="col-xs-12 col-lg-6">
                        <!-- .collapse-course-1 az elso elemnel, collapse-course-2 a masodik elemnel es igy tovabb... -->
                        <div class="collapse box__collapse collapse-course-1">
                            <div class="box__collapse-inner-content">
                                <div class="lesson-list counter-block">
                                @if ($relatedCourses[0]['course']['hasDemoVideo'])
                                    <!-- start item -->
                                        <div class="lesson-list__item">
                                            <h3 class="counter-block__item lesson-list__title heading-3--small">
                                                Demo video
                                            </h3>
                                            <div class="lesson-list__info">
                                                <video controls>
                                                    <source src="{{ route('site.course.demo', [$relatedCourses[0]['course']['id'], $relatedCourses[0]['course']['videoId']]) }}" type='video/mp4'>
                                                </video>
                                            </div>
                                        </div>
                                        <!-- end item -->
                                @endif

                                @foreach ($relatedCourses[0]['course']['lessons'] as $lesson)

                                    <!-- start item -->
                                        <div class="lesson-list__item">
                                            <h3 class="counter-block__item lesson-list__title heading-3--small">
                                                {{ $lesson->title }}
                                            </h3>
                                            {!! $lesson->desc !!}
                                            <div class="lesson-list__info">
                                                {{--
                                                <span class="lesson-list__time">
                                                    <i class="icon-time icon--left" aria-hidden="true"></i>
                                                    <b>14:28</b>
                                                </span>
                                                --}}
                                                <span class="lesson-list__type">
                                                <i class="icon-play icon--left" aria-hidden="true"></i>
                                                <b>{{$lesson->lessontype->name}}</b>
                                            </span>
                                            </div>
                                        </div>
                                        <!-- end item -->

                                    @endforeach

                                </div>

                                <div class="box__collapse-close">
                                    <!-- .collapse-course-1 az elso elemnel, collapse-course-2 a masodik elemnel es igy tovabb... -->
                                    <a role="button" data-toggle="collapse" href=".collapse-course-1" aria-expanded="false" aria-controls="collapse-course-1"  class="link link--purple link--toggle link--toggle-close">
                                        <span>Close</span>
                                        <i class="icon-times icon icon--right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!empty($relatedCourses[1]))
                    <div class="col-xs-12 col-lg-6">
                        <!-- .collapse-course-1 az elso elemnel, collapse-course-2 a masodik elemnel es igy tovabb... -->
                        <div class="collapse box__collapse collapse-course-2">
                            <div class="box__collapse-inner-content">
                                <div class="lesson-list counter-block">
                                @if ($relatedCourses[1]['course']['hasDemoVideo'])
                                    <!-- start item -->
                                        <div class="lesson-list__item">
                                            <h3 class="counter-block__item lesson-list__title heading-3--small">
                                                Demo video
                                            </h3>
                                            <div class="lesson-list__info">
                                                <video controls>
                                                    <source src="{{ route('site.course.demo', [$relatedCourses[1]['course']['id'], $relatedCourses[1]['course']['videoId']]) }}" type='video/mp4'>
                                                </video>
                                            </div>
                                        </div>
                                        <!-- end item -->
                                @endif

                                @foreach ($relatedCourses[1]['course']['lessons'] as $lesson)

                                    <!-- start item -->
                                        <div class="lesson-list__item">
                                            <h3 class="counter-block__item lesson-list__title heading-3--small">
                                                {{ $lesson->title }}
                                            </h3>
                                            {!! $lesson->desc !!}
                                            <div class="lesson-list__info">
                                                {{--
                                                <span class="lesson-list__time">
                                                    <i class="icon-time icon--left" aria-hidden="true"></i>
                                                    <b>14:28</b>
                                                </span>
                                                --}}
                                                <span class="lesson-list__type">
                                                <i class="icon-play icon--left" aria-hidden="true"></i>
                                                <b>{{$lesson->lessontype->name}}</b>
                                            </span>
                                            </div>
                                        </div>
                                        <!-- end item -->

                                    @endforeach


                                </div>
                                <div class="box__collapse-close">
                                    <!-- .collapse-course-1 az elso elemnel, collapse-course-2 a masodik elemnel es igy tovabb... -->
                                    <a role="button" data-toggle="collapse" href=".collapse-course-2" aria-expanded="false" aria-controls="collapse-course-1"  class="link link--purple link--toggle link--toggle-close">
                                        <span>Close</span>
                                        <i class="icon-times icon icon--right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('site.myacademy.course.list') }}" class="btn btn--big btn--blue btn--340 btn--section">
            <span>Check out the full list of academy </span>
        </a>
    </div>
</div>