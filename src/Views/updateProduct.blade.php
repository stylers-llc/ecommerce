@extends('master')

@section('title', ($isUpdate) ? 'Edit product' : 'Create product')

@section('content')
<form method="POST" class="form-horizontal">
    <div class="form-group">
        @if($isUpdate)
            <input type="hidden" name="id" value="{{ $productEntity['id'] }}" />
        @endif
        <div class="checkbox">
            <label>
                <input type="checkbox" name="is_active" {!! (!empty($productEntity['is_active']) && $productEntity['is_active'] == true) ? 'checked' : '' !!} /> Is active
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="is_singleton" {!! (!empty($productEntity['is_singleton']) && $productEntity['is_singleton'] == true) ? 'checked' : '' !!} /> Is singleton
            </label>
        </div>
        <div class="form-group">
            <label for="product_type" class="col-sm-2 control-label">Product type</label>
            <div class="col-sm-10">
                <select class="form-control" name="product_type">
                    @foreach($productTypes as $productType)
                        <option value="{{$productType->name}}" {!! (!empty($productEntity['product_type']) && ($productEntity['product_type'] == $productType->name)) ? 'selected' : '' !!}>
                            {{$productType->name}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="price" class="col-sm-2 control-label">Price</label>
            <div class="col-sm-10">
                <input
                        type="number"
                        id="price"
                        name="price"
                        class="form-control"
                        value="{!! (!empty($productEntity['price'])) ? $productEntity['price'] : null; !!}"
                        min="0"
                        step="0.01"
                />
            </div>
        </div>
        <div class="form-group">
            <label for="stock" class="col-sm-2 control-label">Stock</label>
            <div class="col-sm-10">
                <input
                        type="number"
                        id="stock"
                        name="stock"
                        class="form-control"
                        value="{!! (!empty($productEntity['stock'])) ? $productEntity['stock'] : null; !!}"
                />
            </div>
        </div>
        &nbsp;
        <ul class="nav nav-tabs">
            @for ($i = 0; $i < count($languages); $i++)
                <li role="presentation" {!! ($i == 0) ? 'class="active"' : '' !!}>
                    <a data-toggle="tab" href="#{{$languages[$i]}}">{{$languages[$i]}}</a>
                </li>
            @endfor
        </ul>
        <div class="tab-content">
            &nbsp;
            @for ($i = 0; $i < count($languages); $i++)
                <div id="{{$languages[$i]}}" class="tab-pane fade {!! ($i == 0) ? 'in active' : '' !!}">
                    <div class="form-group">
                        <label for="name[{{$languages[$i]}}]" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input
                                type="text"
                                id="name[{{$languages[$i]}}]"
                                name="name[{{$languages[$i]}}]"
                                class="form-control"
                                value="{!! (!empty($productEntity['name'][$languages[$i]])) ? $productEntity['name'][$languages[$i]] : null; !!}"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descriptions[short_description][{{$languages[$i]}}]" class="col-sm-2 control-label">Short description</label>
                        <div class="col-sm-10">
                            <input
                                    type="text"
                                    id="descriptions[short_description][{{$languages[$i]}}]"
                                    name="descriptions[short_description][{{$languages[$i]}}]"
                                    class="form-control"
                                    value="{!! (!empty($productEntity['descriptions']['short_description'][$languages[$i]])) ? $productEntity['descriptions']['short_description'][$languages[$i]] : null; !!}"
                            />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descriptions[long_description][{{$languages[$i]}}]" class="col-sm-2 control-label">Long description</label>
                        <div class="col-sm-10">
                            <textarea
                                type="text"
                                id="descriptions[long_description][{{$languages[$i]}}]"
                                name="descriptions[long_description][{{$languages[$i]}}]"
                                class="form-control"
                                rows="5"
                            >{!! (!empty($productEntity['descriptions']['long_description'][$languages[$i]])) ? $productEntity['descriptions']['long_description'][$languages[$i]] : null; !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn-primary btn btn-sm">
                            @if($isUpdate)
                                Edit
                            @else
                                Create
                            @endif
                        </button>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</form>
    @if($isUpdate)
        <hr/>
        <form method="post" enctype="multipart/form-data" class="form-horizontal" action="{{ action('\Stylers\Ecommerce\Controllers\ProductController@imageUpload') }}">
            <input type="hidden" name="id" value="{{ $productEntity['id'] }}" />
            <ul class="nav nav-tabs">
                @for ($i = 0; $i < count($languages); $i++)
                    <li role="presentation" {!! ($i == 0) ? 'class="active"' : '' !!}>
                        <a data-toggle="tab" href="#imageDesc{{$languages[$i]}}">{{$languages[$i]}}</a>
                    </li>
                @endfor
            </ul>
            <div class="tab-content">
                &nbsp;
                @for ($i = 0; $i < count($languages); $i++)
                    <div id="#imageDesc{{$languages[$i]}}" class="tab-pane fade {!! ($i == 0) ? 'in active' : '' !!}">
                        <div class="form-group">
                            <label for="description[{{$languages[$i]}}]" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" id="description[{{$languages[$i]}}]" name="description[{{$languages[$i]}}]" class="form-control" />
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Upload image</label>
                <div class="col-sm-10">
                    <input type="file" id="file" name="file" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-primary btn btn-sm">Upload</button>
            </div>
        </form>
    @endif
    @if (!empty($productEntity['gallery']['items']))
        <div class="row">
        @foreach($productEntity['gallery']['items'] as $image)
                <div class="col-xs-6 col-md-3 thumbnail">
                    <picture>
                        @foreach($image['thumbnails'] as $thumbnail)
                            <source media="(min-width: {{$thumbnail['width']}})" srcset="/{{$thumbnail['path']}}">
                        @endforeach
                        <img src="/{{$image['path']}}" alt="{{$image['description']['en']}}" style="width:auto;">
                    </picture>
                </div>
        @endforeach
        </div>
    @endif
@endsection