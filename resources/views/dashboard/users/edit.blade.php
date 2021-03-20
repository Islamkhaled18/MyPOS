@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section>
            <h1>{{ trans('site.users') }}

            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard">
                        </i>{{ trans('site.dashboard') }}</a></li>
                <li><a href="{{ route('dashboard.users.index') }}"> @lang('site.users')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1 class="box-title">{{ trans('site.edit') }}</h1>

                </div>
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label>{{ trans('site.first_name') }}</label>
                            <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}"
                                placeholder="first name">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.last_name') }}</label>
                            <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}"
                                placeholder="last name">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.email') }}</label>
                            <input type="text" name="email" class="form-control" value="{{ $user->email}}"
                                placeholder="Email">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        <div class="form-group">
                            <img src="{{ $user->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>


                        <div class="form-group">
                            <label>{{ trans('site.permissions') }}</label>
                            <div class="nav-tabs-custom">


                                @php
                                    $models = ['users','categories','products' , 'clients' , 'orders'];
                                    $maps = ['create', 'read', 'update', 'delete'];

                                @endphp

                                <ul class="nav nav-tabs">
                                    @foreach ($models as $index => $model)
                                        <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}"
                                                data-toggle="tab">@lang('site.' . $model)</a></li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach ($models as $index => $model)
                                        <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">

                                            @foreach ($maps as $map)

                                                <label><input type="checkbox" name="permissions[]" {{$user->haspermission($map . '_' . $model) ? 'checked' : '' }}
                                                        vlaue="{{ $map . '_' . $model }}">@lang('site.' . $map)</label><br>

                                            @endforeach

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-edit"></i>{{ trans('site.edit') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </section>

    </div>


@stop
