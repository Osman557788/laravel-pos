@extends('dashboard.layout')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">create client</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">create client</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <div class="row" id="app" style="margin:1px">
    <div class="col-md-6">

      <div class="card card-primary">

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
                      <th>add</th>
                    </tr>

                  
                    <tr v-for="product in category.product">
                      <td>@{{product.name}}</td>
                      <td>@{{product.stock}}</td>
                      <td>@{{product.sale_price}}</td>
                      <td>
                        <button class="btn btn-success block" :disabled='product.disblay' @click="getOrder(product)" >
                          add 
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
      <div class="card card-success ">
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
                    <th>delete</th>

                </tr>
                </thead>

                <tbody class="order-list" v-for="order in orders">
                <tr>
                  <div class="row">
                    <div class="col-2">
                      <td> @{{order.name}}</td>
                    </div>
                    <div class="col-2">
                      <td><input type="number" min=1 v-model="order.quantity"></td>
                    </div>
                    <div class="col-2">
                      <td> $ @{{order.sale_price}}</td>
                    </div>
                    <div class="col-2">  
                      <td> <button @click ="removeFromList(order)" class="btn btn-primary" >remove</td>
                    </div>    
                  </div>  

                </tr>  

                </tbody>

            </table><!-- end of table -->

            <h4>total : <span class="total-price">$@{{totalPrice()}}</span></h4>

            <button class="btn btn-primary " @click.once="osman"><i class="fa fa-plus"></i> add order</button>

        </form>
        </div>
      </div>
    </div>
  </div>


  @endsection