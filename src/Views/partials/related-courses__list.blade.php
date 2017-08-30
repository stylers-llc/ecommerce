<div class="related-products-list">
    <div class="row row--30">

        <div class="table table--border-spacing table--main h--100">

            <div class="col-xs-12 col-lg-6 table__cell table__cell--vtop h--100">
                <div class="table h--100">
                    <div class="table__cell table__cell--vtop h--100 col-xs-12 col-sm-6 box__img-content" style="background-image: url('@{{ courses[0].gallery.items[0].thumbnails[0].path }}')">
                        <img src="@{{ courses[0].gallery.items[0].thumbnails[0].path }}" alt="@{{ courses[0].name.en }}" class="visible-xs">
                    </div>
                    <div class="table__cell table__cell--vtop h--100 col-xs-12 col-sm-6 box__text-content bg--lightgray">
                        <div class="table h--100 box">
                            <div class="table__row h--100">
                                <div class="table__cell table__cell--vtop box__inner-content">
                                    <span class="box__category box__category--small">@{{ courses[0].category }}</span>
                                    <h3 class="heading-line heading-3--big"><a href="/_sitebuild/academy_course-details" class="link--purple">@{{ courses[0].name.en }}</a></h3>
                                    <p>@{{ courses[0].descriptions.short_description.en }}</p>
                                </div>
                            </div>
                            <div class="table__row">
                                <div class="table__cell table__cell--vtop box__buttons">
                                    <div class="table">
                                        <div class="table__cell table__cell--vmiddle w--100">
                                            @if( empty(Auth::user()->name) )
                                                <b class="box__price-text">
                                                    Please sign in <br> to view the price
                                                </b>
                                            @else
                                                <b class="box__price box__price--small">@{{ courses[0].price }} $</b>
                                            @endif
                                        </div>

                                        <div class="table__cell table__cell--vmiddle">
                                            <a href="#" class="btn btn--small btn--blue">
                                                <span>buy now</span>
                                                <i class="icon-cart icon--right" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <!-- .collapse-course-1 az elso elemnel, collapse-course-2 a masodik elemnel es igy tovabb... -->
                                        <a role="button" data-toggle="collapse" href=".collapse-course-1" aria-expanded="false" aria-controls="collapse-course-1" class="link link--purple link--toggle">
                                            <span>List of lesson</span>
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
                    <div class="collapse box__collapse collapse-course-1">
                        <div class="box__collapse-inner-content">
                            <div class="lesson-list counter-block">

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Lesson title quis nostrud exercitation
                                    </h3>
                                    <p>Adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wim, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-play icon--left" aria-hidden="true"></i>
                                <b>VIDEO</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Lesson title quis nostrud exercitation
                                    </h3>
                                    <p>Adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wim, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-play icon--left" aria-hidden="true"></i>
                                <b>VIDEO</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Elit sed diam nonummy
                                    </h3>
                                    <p>Tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-edit icon--left" aria-hidden="true"></i>
                                <b>test</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->


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


            </div>

            <div class="col-xs-12 col-lg-6 table__cell table__cell--vtop h--100">
                <div class="table h--100">
                    <div class="table__cell table__cell--vtop h--100 col-xs-12 col-sm-6 box__img-content" style="background-image: url('@{{ courses[1].gallery.items[0].thumbnails[0].path }}')">
                        <img src="@{{ courses[1].gallery.items[0].thumbnails[0].path }}" alt="@{{ courses[1].name.en }}" class="visible-xs">
                    </div>
                    <div class="table__cell table__cell--vtop h--100 col-xs-12 col-sm-6 box__text-content bg--lightgray">
                        <div class="table h--100 box">
                            <div class="table__row h--100">
                                <div class="table__cell table__cell--vtop box__inner-content">
                                    <span class="box__category box__category--small">@{{ courses[1].category }}</span>
                                    <h3 class="heading-line heading-3--big"><a href="/_sitebuild/academy_course-details" class="link--purple">@{{ courses[1].name.en }}</a></h3>
                                    <p>@{{ courses[1].descriptions.short_description.en }}</p>
                                </div>
                            </div>
                            <div class="table__row">
                                <div class="table__cell table__cell--vtop box__buttons">
                                    <div class="table">
                                        <div class="table__cell table__cell--vmiddle w--100">
                                            @if( empty(Auth::user()->name) )
                                                <b class="box__price-text">
                                                    Please sign in <br> to view the price
                                                </b>
                                            @else
                                                <b class="box__price box__price--small">@{{ courses[1].price }} $</b>
                                            @endif
                                        </div>

                                        <div class="table__cell table__cell--vmiddle">
                                            <a href="#" class="btn btn--small btn--blue">
                                                <span>buy now</span>
                                                <i class="icon-cart icon--right" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <!-- .collapse-course-1 az elso elemnel, collapse-course-2 a masodik elemnel es igy tovabb... -->
                                        <a role="button" data-toggle="collapse" href=".collapse-course-2" aria-expanded="false" aria-controls="collapse-course-1" class="link link--purple link--toggle">
                                            <span>List of lesson</span>
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
                    <div class="collapse box__collapse collapse-course-2">
                        <div class="box__collapse-inner-content">
                            <div class="lesson-list counter-block">

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Lesson title quis nostrud exercitation
                                    </h3>
                                    <p>Adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wim, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-play icon--left" aria-hidden="true"></i>
                                <b>VIDEO</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Lesson title quis nostrud exercitation
                                    </h3>
                                    <p>Adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wim, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-play icon--left" aria-hidden="true"></i>
                                <b>VIDEO</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Elit sed diam nonummy
                                    </h3>
                                    <p>Tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-edit icon--left" aria-hidden="true"></i>
                                <b>test</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Elit sed diam nonummy
                                    </h3>
                                    <p>Tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-edit icon--left" aria-hidden="true"></i>
                                <b>test</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Elit sed diam nonummy
                                    </h3>
                                    <p>Tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-edit icon--left" aria-hidden="true"></i>
                                <b>test</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->


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


            </div>

        </div>

    </div>

    <div class="row visible-lg">
        <div class="related-products-list__collapse-contents">
            <div class="clearfix">
                <div class="col-xs-12 col-lg-6">
                    <!-- .collapse-course-1 az elso elemnel, collapse-course-2 a masodik elemnel es igy tovabb... -->
                    <div class="collapse box__collapse collapse-course-1">
                        <div class="box__collapse-inner-content">
                            <div class="lesson-list counter-block">

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Lesson title quis nostrud exercitation
                                    </h3>
                                    <p>Adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wim, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-play icon--left" aria-hidden="true"></i>
                                <b>VIDEO</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Lesson title quis nostrud exercitation
                                    </h3>
                                    <p>Adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wim, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-play icon--left" aria-hidden="true"></i>
                                <b>VIDEO</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Elit sed diam nonummy
                                    </h3>
                                    <p>Tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-edit icon--left" aria-hidden="true"></i>
                                <b>test</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->


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
                <div class="col-xs-12 col-lg-6">
                    <!-- .collapse-course-1 az elso elemnel, collapse-course-2 a masodik elemnel es igy tovabb... -->
                    <div class="collapse box__collapse collapse-course-2">
                        <div class="box__collapse-inner-content">
                            <div class="lesson-list counter-block">

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Lesson title quis nostrud exercitation
                                    </h3>
                                    <p>Adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wim, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-play icon--left" aria-hidden="true"></i>
                                <b>VIDEO</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Lesson title quis nostrud exercitation
                                    </h3>
                                    <p>Adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wim, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-play icon--left" aria-hidden="true"></i>
                                <b>VIDEO</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Elit sed diam nonummy
                                    </h3>
                                    <p>Tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-edit icon--left" aria-hidden="true"></i>
                                <b>test</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Elit sed diam nonummy
                                    </h3>
                                    <p>Tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-edit icon--left" aria-hidden="true"></i>
                                <b>test</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->

                                <!-- start item -->
                                <div class="lesson-list__item">
                                    <h3 class="counter-block__item lesson-list__title heading-3--small">
                                        Elit sed diam nonummy
                                    </h3>
                                    <p>Tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                                    <div class="lesson-list__info">
                            <span class="lesson-list__time">
                                <i class="icon-time icon--left" aria-hidden="true"></i>
                                <b>14:28</b>
                            </span>
                            <span class="lesson-list__type">
                                <i class="icon-edit icon--left" aria-hidden="true"></i>
                                <b>test</b>
                            </span>
                                    </div>
                                </div>
                                <!-- end item -->


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
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="/ecommerce/products/list" class="btn btn--big btn--blue btn--340 btn--section">
            <span>Check out the full list of products </span>
        </a>
    </div>
</div>