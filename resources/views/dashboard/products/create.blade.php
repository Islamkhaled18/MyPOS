@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section>
            <h1>{{trans('site.products')}}

            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard">
                        </i>{{trans('site.dashboard')}}</a></li>
                <li><a href="{{ route('dashboard.products.index') }}">{{trans('site.products')}}</a></li>
                <li class="active"> @lang('site.add')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1 class="box-title">{{trans('site.add')}}</h1>

                </div>
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{ method_field('post') }}

                        <div class='form-group'>

                          <label>@lang('site.categories')</label>
                          <select name="category_id" class="form-control">
                            <option value=''>@lang('site.all_categories')</option>

                             @foreach ($categories as $category)
                                <option value='{{ $category->id}}' {{old('category_id') == $category->id ? 'selected' : '' }} >{{$category->name}}</option>
                             @endforeach
                          </select>

                        </div>

                            <div class="form-group">
                                <label>@lang('site.product_Name')</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.description')</label>
                                <textarea type="text" name="description" class="form-control ckeditor">{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>{{trans('site.image')}}</label>
                                <input type="file" name="image" class="form-control image " placeholder="Image">
                            </div>

                            <div class="form-group">
                                <img src="{{ asset('uploads/product_images/default.jpg')}}" style="width:50px" class="img-thumbnail image-preview" alt="">
                            </div>

                            <div class="form-group">
                                <label>{{trans('site.purchase_price')}}</label>
                                <input type="number" name="purchase_price" step="0.01" class="form-control" value="{{ old('purchase_price') }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('site.sale_price')}}</label>
                                <input type="number" name="sale_price" step="0.01" class="form-control" value="{{ old('sale_price') }}">
                            </div>

                            <div class="form-group">
                                <label>{{trans('site.stock')}}</label>
                                <input type="number" name="stock" class="form-control" value="{{ old('stock') }}">
                            </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>{{trans('site.add')}}</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>

    </div>


@stop
