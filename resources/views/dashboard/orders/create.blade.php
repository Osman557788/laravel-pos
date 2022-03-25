@extends('dashboard.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> order create </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">order create</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="row" id="app" style="margin:1px">
    <div class="col-md-6">

      <div class="card">

        <div class="card-header">
            <h3> categories </h3>
        </div><!-- end of box header -->

        <div  class="card-body">

          <div class="panel-group"  v-for="category in categories">

            <div class="panel panel-info">

              <div class="panel-heading">
                <button class="btn btn-navbadr block">    
                <h4 class="panel-title">
                  <a data-toggle="collaps" id="name" href="#id">@{{category.name}} </a>
                </h4>
                </button>
              </div>

              <div class="panel-collapse collaps">

                <div class="panel-body">

                  

                  <table class="table table-hover">
                    <tr>
                      <th>name</th>
                      <th>stock</th>
                      <th>price</th>
                      <th></th>
                    </tr>

                  
                    <tr v-for="product in category.products">
                      <td>@{{product.name}}</td>
                      <td>@{{product.stock}}</td>
                      <td>@{{product.sale_price}}</td>
                      <td>
                        <button class="btn btn-success block" :disabled='product.disblay' @click="getOrder(product)" >
                          <i class="fa fa-plus"></i>
                        </button> 
                        {{-- <input type="checkbox" v-bind:value="product.name" v-model="order" >  --}}
                      </td>
                    </tr>
                

                  </table><!-- end of table -->

                 

                </div><!-- end of panel body -->

              </div><!-- end of panel collapse -->

            </div><!-- end of panel primary -->

          </div><!-- end of panel group -->

        

        </div><!-- end of box body -->

      </div><!-- end of box -->

    </div><!-- end of col -->
    <div class="col-6">
      <div class="card ">
        <div class="card-header">
          <h3>order</h3>
        </div>
        <div class="card-body">
          <form  v-on:submit.prevent action="{{ $client->id }}" method="post">
            {{ csrf_field() }}
            {{ method_field('post') }}
            @include('partials._errors')
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>product</th>
                    <th>quantity</th>
                    <th>price</th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="order-list" v-for="order in orders">
                <tr>
                  <div class="row">
                    <div class="col-2">
                      <td> @{{order.name}}</td>
                    </div>
                    <div class="col-2">
                      <td><input type="number" min=1 v-model="order.quntity"></td>
                    </div>
                    <div class="col-2">
                      <td> $ @{{order.sale_price}}</td>
                    </div>
                    <div class="col-2">  
                      <td> <button @click ="removeFromList(order)" class="btn btn-danger" ><i class="fa fa-trash"></i></td>
                    </div>    
                  </div>  
                </tr>  
                </tbody>

            </table><!-- end of table -->

            <h4>total : <span class="total-price">$@{{totalPrice()}}</span></h4>

            <button class="btn btn-info" @click="submitForm({{$client->id}})"><i class="fa fa-plus"></i> add order</button>

        </form>
        </div>
      </div>
      @if($client->orders->count() > 0 )
      <div class="card  ">
        <div class="card-header">
          <h3>brevous order</h3>
        </div>
        <div class="card-body">
          @include('partials._errors')
          @foreach ($orders as $order)  

            <div class="panel-group">

              <div class="panel panel-success">

                  <div class="panel-heading">
                      <h4 class="panel-title">
                          <a data-toggle="collapse" href="#{{ $order->created_at->format('d-m-Y-s') }}">{{ $order->created_at->toFormattedDateString() }}</a>
                      </h4>
                  </div>

                  <div id="{{ $order->created_at->format('d-m-Y-s') }}" class="panel-collapse collapses">

                      <div class="panel-body">

                          <ul class="list-group">
                              @foreach ($order->products as $product)
                                  <li class="list-group-item">{{ $product->name }}</li>
                              @endforeach
                          </ul>

                      </div><!-- end of panel body -->

                  </div><!-- end of panel collapse -->

              </div><!-- end of panel primary -->

            </div><!-- end of panel group -->
          @endforeach
          {{ $orders->links() }}


        </div>
      </div>
      
    </div>
    @endif
    
    
  </div>
</div>
@endsection
@push('scripts')
<script src="{{asset("js/vue.js")}}"></script>    
@endpush