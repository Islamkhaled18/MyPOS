@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section>
            <h1>{{trans('site.clients')}}

            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard">
                        </i>{{trans('site.dashboard')}}</a></li>
                <li><a href="{{ route('dashboard.clients.index') }}">{{trans('site.clients')}}</a></li>
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

                    <form action="{{ route('dashboard.clients.store') }}" method="POST">
                        {{csrf_field()}}
                        {{ method_field('post') }}

                            <div class="form-group">
                                <label>@lang('site.client_Name')</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            </div>

                           @for ($i = 0; $i < 2; $i++)
                                <div class="form-group">
                                    <label>@lang('site.phone')</label>
                                    <input type="text" name="phone[]" class="form-control">
                                </div>
                           @endfor

                            <div class="form-group">
                                <label>@lang('site.address')</label>
                                <textarea name="address" class="form-control" >{{ old('address') }}</textarea>
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
