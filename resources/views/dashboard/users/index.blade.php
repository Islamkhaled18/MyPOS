@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section>
            <h1>{{trans('site.users')}}

            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a>
                </li>
                <li class="active">
                    @lang('site.users')
                </li>
            </ol>
        </section>
        <section>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1 class="box-title" style="margin-bottom: 15px">{{trans('site.users')}} <small>{{$users->total()}} </small></h1>
                    <form action="{{ route('dashboard.users.index') }}" method='get'>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="{{trans('site.search')}}" value="{{ request()->search }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if (auth()->user()->hasPermission('users_create'))
                                    <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    @if( $users->count() > 0 )
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('site.first_name')}}</th>
                                <th>{{trans('site.last_name')}}</th>
                                <th>{{trans('site.email')}}</th>
                                <th>{{trans('site.image')}}</th>
                                <th>{{trans('site.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach( $users as $index=>$user)
                                    <tr>
                                        <td>{{$loop -> iteration}}</td>
                                        <td>{{$user -> first_name}}</td>
                                        <td>{{$user -> last_name}}</td>
                                        <td>{{$user -> email}}</td>
                                        <td><img src="{{ $user->image_path }}" style="width:50px" alt=""></td>
                                        <td>
                                            @if(auth()->user()->hasPermission('users_update'))
                                            <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-bitbucket btn-sm"><i class="fa fa-edit>"</i>{{trans('site.edit')}}</a>
                                            @else
                                            <a href="#" class="btn btn-bitbucket btn-sm "><i class="fa fa-edit>"</i>{{trans('site.edit')}}</a>
                                            @endif


                                            @if(auth()->user()->haspermission('users_delete'))
                                                <form action="{{route('dashboard.users.destroy', $user->id)}}" method="post" style="display: inline-block">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <button type="'submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i>{{trans('site.delete')}}</button>

                                                </form>
                                            @else

                                                <button class="btn btn-danger"><i class="fa fa-trash"></i>@lang('site.delete')</button>

                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $users->appends(Request()->query())->links() }}


                    @else
                        <h2>{{trans('site.no_data_found')}}</h2>
                    @endif
                </div>
            </div>
        </section>

    </div>


@stop
