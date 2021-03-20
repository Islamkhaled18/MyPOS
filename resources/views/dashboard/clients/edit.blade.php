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
                <li class="active"> @lang('site.edit')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1 class="box-title">{{trans('site.edit')}}</h1>

                </div>
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.clients.update',$client->id) }}" method="POST">
                        {{csrf_field()}}
                        {{ method_field('PUT') }}

                            <div class="form-group">
                                <label>@lang('site.client_Name')</label>
                                <input type="text" name="name" class="form-control" value="{{ $client->name }}">
                            </div>

                           @for ($i = 0; $i < 2; $i++)
                                <div class="form-group">
                                    <label>@lang('site.phone')</label>
                                    <input type="text" name="phone[]" class="form-control" value="{{ $client->phone[$i] ?? '' }}">
                                </div>
                           @endfor

                            <div class="form-group">
                                <label>@lang('site.address')</label>
                                <textarea name="address" class="form-control" >{{ $client->address }}</textarea>
                            </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>{{trans('site.edit')}}</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>

    </div>


@stop
