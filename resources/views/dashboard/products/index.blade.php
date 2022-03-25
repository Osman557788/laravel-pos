@extends('dashboard.layout')



@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">products</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">products</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->

  <div id='app3' class="box box-primary">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-5 ">
                <form action="{{ route('dashboard.product.index') }}" method="get">

                  <div class="row">

                    <div class="col-md-8">
                      <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                        value="{{ request()->search }}">
                    </div>

                    <div class="col-md-4">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                        @lang('site.search')</button>
                    </div>

                  </div>
                </form><!-- end of form -->
              </div>
              <div class="col-md-5">
                <a class="  btn btn-primary " href="{{url('dashboard/product/create')}}"> + add product </a>
              </div>
            </div>
          </div>

        </div>
        <!-- /.card-header -->

        @if ($products->count() > 0)

        <div id="deletes" class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>#</th>
                <th>product name</th>
                <th>description</th>
                <th>category</th>
                <th>image</th>
                <th>purchase price</th>
                <th>sale price</th>
                <th>profit percent %</th>
                <th>stock</th>
                <th>action</th>

              </tr>
            </thead>
            <tbody>
              @foreach($products as $index=>$product)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{$product->description }}</td>
                <td>{{ $product->catgorie->name }}</td>
                <td><img src="{{ asset('uploads/products_images/'.$product->image )}}" style="width:100px"class="img-thumbnail"></td>
                <td>{{ $product->purchase_price }}</td>
                <td>{{ $product->sale_price }}</td>
                <td>{{ $product->profit_percent }} %</td>
                <td>{{ $product->stock }}</td>
                <td>
                  @if (auth()->user()->hasPermission('products-update'))
                  <a href="{{ route('dashboard.product.edit', $product->id) }}" class="btn btn-info btn-sm"><i
                      class="fa fa-edit"></i> edit </a>
                  @else
                  <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                  @endif
                  @if (auth()->user()->hasPermission('products-delete'))
                  <form action="{{ route('dashboard.product.destroy', $product->id) }}" method="post"
                    style="display: inline-block">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> delete
                    </button>
                  </form><!-- end of form -->
                  @else
                  <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                    @lang('site.delete')</button>
                  @endif
                </td>
              </tr>

              @endforeach
            </tbody>
          </table>
          <div class="row">

            @else
            <div style="margin: 10%">
              <h2> no product found in this page </h2>
            </div>
            @endif


            <div class="col-12 d-flex justify-content-center ">

              {{ $products->appends(request()->query())->links() }}

            </div>

          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>



@endsection