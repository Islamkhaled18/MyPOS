@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section>
            <h1>{{trans('site.products')}}

            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a>
                </li>
                <li class="active">
                    @lang('site.products')
                </li>
            </ol>
        </section>
        <section>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1 class="box-title" style="margin-bottom: 15px">{{trans('site.products')}} <small>{{$products->total()}} </small></h1>
                    <form action="{{ route('dashboard.products.index') }}" method='get'>
                        <div class="row">
                          <div class="col-md-4">
                              <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                          </div>

                            <div class="col-md-4">
                                <select name="category_id" class="form-control">
                                    <option value="">@lang('site.all_categories')</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{request()->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if (Auth()->user()->hasPermission('products_create'))
                                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    @if( $products->count() > 0 )
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('site.name')}}</th>
                                <th>{{trans('site.description')}}</th>
                                <th>{{trans('site.category')}}</th>
                                <th>{{trans('site.image')}}</th>
                                <th>{{trans('site.purchase_price')}}</th>
                                <th>{{trans('site.sale_price')}}</th>
                                <th>{{trans('site.profit_percent')}} %</th>
                                <th>{{trans('site.stock')}}</th>
                                <th>{{trans('site.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach( $products as $index=>$product)
                                    <tr>
                                        <td>{{$loop -> iteration}}</td>
                                        <td>{{$product -> name}}</td>
                                        <td>{!! $product -> description !!}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td><img src="{{$product->image_path}}" style="width:100px" class="img-thumbnail" alt=""></td>
                                        <td>{{$product -> purchase_price}}</td>
                                        <td>{{$product -> sale_price}}</td>
                                        <td>{{$product -> profit_percent}} %</td>
                                        <td>{{$product -> stock}}</td>

                                        <td>
                                            @if(Auth()->user()->hasPermission('products_update'))
                                            <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-bitbucket btn-sm"><i class="fa fa-edit>"</i>{{trans('site.edit')}}</a>
                                            @else
                                            <a href="#" class="btn btn-bitbucket btn-sm "><i class="fa fa-edit>"</i>{{trans('site.edit')}}</a>
                                            @endif


                                            @if(Auth()->user()->haspermission('products_delete'))
                                                <form action="{{route('dashboard.products.destroy', $product->id)}}" method="post" style="display: inline-block">
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

                        {{ $products->appends(Request()->query())->links() }}


                    @else
                        <h2>{{trans('site.no_data_found')}}</h2>
                    @endif
                </div>
            </div>
        </section>

    </div>


@stop
