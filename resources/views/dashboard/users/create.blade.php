@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section>
            <h1>{{trans('site.users')}}

            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard">
                        </i>{{trans('site.dashboard')}}</a></li>
                <li><a href="{{ route('dashboard.users.index') }}">{{trans('site.users')}}</a></li>
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

                    <form action="{{ route('dashboard.users.store') }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label>{{trans('site.first_name')}}</label>
                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="first name">
                        </div>
                        <div class="form-group">
                            <label>{{trans('site.last_name')}}</label>
                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="last name">
                        </div>
                        <div class="form-group">
                            <label>{{trans('site.email')}}</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>{{trans('site.image')}}</label>
                            <input type="file" name="image" class="form-control image " placeholder="Image">
                        </div>

                        <div class="form-group">
                            <img src="{{ asset('uploads/user_images/default.PNG')}}" style="width:50px" class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group">
                            <label>{{trans('site.password')}}</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label>{{trans('site.password_confirmation')}}</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation">
                        </div>


                        <div class="form-group">
                            <label>{{trans('site.permissions')}}</label>
                            <div class="nav-tabs-custom">


                                @php
                                    $models = ['users','categories','products' , 'clients' , 'orders'];
                                    $maps = ['create','read','update','delete'];

                                @endphp

                                <ul class="nav nav-tabs">
                                    @foreach ($models as $index => $model)
                                        <li class="{{ $index == 0 ? 'active' : ''}}"><a href="#{{$model}}" data-toggle="tab">@lang('site.' . $model)</a></li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach($models as $index => $model)
                                        <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$model}}">

                                            @foreach($maps as $map)

                                                <label><input type="checkbox" name="permissions[]" vlaue="{{$map . '_' . $model}}">@lang('site.' . $map)</label><br>

                                            @endforeach

                                        </div>
                                    @endforeach
                                </div>
                            </div>
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
