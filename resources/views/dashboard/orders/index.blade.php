@extends('dashboard.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">orders</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">orders</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div id=orders class="row">
    <div class="col-7">
      <div class="box box-primary">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="container-fluid">
                <div class="rows">
                  <div class="cosl-md-5 ">
                    <form action="{{ route('dashboard.orders.index') }}" method="get">

                      <div class="row">

                        <div class="cols-md-8">
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
                </div>
              </div>

            </div>
            <!-- /.card-header -->

            @if ($orders->count() > 0)

            <div id="deletes" class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>client name</th>
                    <th>price</th>
                    <th>create at</th>
                    <th>action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($orders as $index=>$order)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->client->name}}</td>
                    <td>{{$order->price }}</td>
                    <td>{{ $order->created_at}}</td>
                    <td>
                      @if (auth()->user()->hasPermission('orders-update'))
                      <a href="{{ route('dashboard.orders.edit', $order->id) }}"
                        class="btn btn-info btn-sm"><i class="fa fa-edit"></i> edit </a>
                      @else
                      <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> edit</a>
                      @endif
                      @if (auth()->user()->hasPermission('orders-read'))
                      <a class="btn btn-warning btn-sm" @click="showOrder({{$order->id}})"><i
                          class="fa fa-list"></i> show </a>
                      @else
                      <a href="#" class="btn btn-info btn-sm disabled.create"><i class="fa fa-edit"></i> edit</a>
                      @endif
                      @if (auth()->user()->hasPermission('orders-delete'))
                      <form action="orders/{{$order->id}}" method="post"
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


              @else
              <div style="margin: 10%">
                <h2> no order found in this page </h2>
              </div>
              @endif


              <div class="col-12 d-flex justify-content-center ">

                {{ $orders->appends(request()->query())->links() }}

              </div>

            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <div class="col-md-4">

      <div class="card ">

        <div class="card-header">
          <h3 class="card-title" style="margin-bottom: 10px">show products</h3>
        </div><!-- end of box header -->

        <div class="card-body">

          <div v-if="lauding" style=" flex-direction: column; align-items: center;" id="loading">
            <div class="loader"></div>
            <p style="margin-top: 10px">جاري التحميل</p>
          </div>
          <div v-if="success" >
            <div  id="order-product-list">
              <div v-html="orderProducts" id="print-area">
              </div>
            </div>
            <button @click="print()" class="btn btn-block btn-primary print-btn"><i class="fa fa-print"></i> print</button>
          </div>
        </div><!-- end of order product list -->

      </div><!-- end of box body -->

    </div><!-- end of box -->

  </div><!-- end of col -->
</div>

</div>
@endsection
@push('scripts')
<script src="{{asset("js/orders.js")}}"></script>    
@endpush