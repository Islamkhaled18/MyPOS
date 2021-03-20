@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section>
            <h1>{{trans('site.categories')}}

            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a>
                </li>
                <li class="active">
                    @lang('site.categories')
                </li>
            </ol>
        </section>
        <section>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1 class="box-title" style="margin-bottom: 15px">{{trans('site.categories')}} <small>{{$categories->total()}} </small></h1>
                    <form action="{{ route('dashboard.categories.index') }}" method='get'>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="{{trans('site.search')}}" value="{{ request()->search }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if (Auth()->user()->hasPermission('categories_create'))
                                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    @if( $categories->count() > 0 )
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('site.name')}}</th>
                                <th>{{trans('site.products_count')}}</th>
                                <th>{{trans('site.related_products')}}</th>
                                <th>{{trans('site.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach( $categories as $index=>$category)
                                    <tr>
                                        <td>{{$loop -> iteration}}</td>
                                        <td>{{$category -> name}}</td>
                                        <td>{{$category -> products->count()}}</td>
                                        <td><a href="{{ route('dashboard.products.index', ['category_id' => $category->id]) }}" class="btn btn-info btn-sm">@lang('site.related_products')</a></td>
                                        <td>
                                            @if(Auth()->user()->hasPermission('categories_update'))
                                            <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-bitbucket btn-sm"><i class="fa fa-edit>"</i>{{trans('site.edit')}}</a>
                                            @else
                                            <a href="#" class="btn btn-bitbucket btn-sm "><i class="fa fa-edit>"</i>{{trans('site.edit')}}</a>
                                            @endif


                                            @if(Auth()->user()->haspermission('categories_delete'))
                                                <form action="{{route('dashboard.categories.destroy', $category->id)}}" method="post" style="display: inline-block">
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

                        {{ $categories->appends(Request()->query())->links() }}


                    @else
                        <h2>{{trans('site.no_data_found')}}</h2>
                    @endif
                </div>
            </div>
        </section>

    </div>


@stop
