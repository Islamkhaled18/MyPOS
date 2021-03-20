@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section>
            <h1>{{trans('site.categories')}}

            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard">
                        </i>{{trans('site.dashboard')}}</a></li>
                <li><a href="{{ route('dashboard.categories.index') }}">{{trans('site.categories')}}</a></li>
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

                    <form action="{{ route('dashboard.categories.store') }}" method="POST">
                        {{csrf_field()}}
                        {{ method_field('post') }}

                            <div class="form-group">
                                <label>@lang('site.category_Name')</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
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
