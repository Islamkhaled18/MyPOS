@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section>
            <h1>{{trans('site.clients')}}

            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a>
                </li>
                <li class="active">
                    @lang('site.clients')
                </li>
            </ol>
        </section>
        <section>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1 class="box-title" style="margin-bottom: 15px">{{trans('site.clients')}} <small>{{$clients->total()}} </small></h1>
                    <form action="{{ route('dashboard.clients.index') }}" method='get'>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="{{trans('site.search')}}" value="{{ request()->search }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if (Auth()->user()->hasPermission('clients_create'))
                                    <a href="{{ route('dashboard.clients.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    @if( $clients->count() > 0 )
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('site.name')}}</th>
                                <th>{{trans('site.phone')}}</th>
                                <th>{{trans('site.address')}}</th>
                                <th>{{trans('site.add_order')}}</th>
                                <th>{{trans('site.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $index=>$client)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$client->name}}</td>
                                        <td>{{ is_array($client->phone) ? implode($client->phone, '-') : $client->phone }}</td>
                                        <td>{{$client->address}}</td>
                                        <td>
                                          @if(Auth()->user()->hasPermission('orders_create'))
                                          <a href="{{ route('dashboard.clients.orders.create', $client->id) }}"
                                            class="btn btn-primary btn-sm">@lang('site.add_order')</a>
                                            @else
                                            <a href="#" class="btn btn-primary btn-sm disabled">@lang('site.add_order')</a>
                                          @endif
                                        </td>
                                        <td>
                                            @if(Auth()->user()->hasPermission('clients_update'))
                                            <a href="{{ route('dashboard.clients.edit', $client->id) }}" class="btn btn-bitbucket btn-sm"><i class="fa fa-edit>"</i>{{trans('site.edit')}}</a>
                                            @else
                                            <a href="#" class="btn btn-bitbucket btn-sm "><i class="fa fa-edit>"</i>{{trans('site.edit')}}</a>
                                            @endif


                                            @if(Auth()->user()->haspermission('clients_delete'))
                                                <form action="{{route('dashboard.clients.destroy', $client->id)}}" method="post" style="display: inline-block">
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

                        {{ $clients->appends(Request()->query())->links() }}


                    @else
                        <h2>{{trans('site.no_data_found')}}</h2>
                    @endif
                </div>
            </div>
        </section>

    </div>


@stop
