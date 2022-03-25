@extends('dashboard.layout')



@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">           
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">clients</h1> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">clients</li>
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
                      <form action="{{ route('dashboard.client.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-8">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                            </div>

                        </div>
                      </form><!-- end of form -->
                     </div>
                      <div class="col-md-5">
                         <a class="  btn btn-primary " href="{{url('dashboard/client/create')}}"> + add client </a>
                      </div>
                    </div>
                  </div>
                 
              </div>
              <!-- /.card-header -->

            @if ($clients->count() > 0)

              <div id="deletes" class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>client name</th>
                      <th>phon numper</th>
                      <th>email</th>
                      <th>action</th>
                      
                    </tr>
                  </thead>
                  <tbody>


                  	@foreach($clients as $index=>$client)
                    <tr>
                      <td>{{$index+1}}</td>
                      <td>{{$client->name}}</td>
                      <td>{{$client->phon_number}}</td>
                      <td>{{$client->email}}</td>

                      <td>
                        <div class="second ">

                          <a class="btn btn-info" href="{{ route('dashboard.clients.orders.create', $client->id) }}"> <i class="fa fa-plus"></i>add order</a>  
                          @if(auth()->user()->haspermission('categories-update'))
                          
                      	   <a class="btn btn-warning" href="{{ route('dashboard.client.edit', $client->id) }}"> <i class="fa fa-edit"></i></a>    
                          
                          @endif
                          
                          @if(auth()->user()->haspermission('categories-delete'))

                           <form  action="{{ route('dashboard.client.destroy', $client->id) }}" method="post" style="display: inline-block">
                             {{ csrf_field() }}
                             {{ method_field('delete') }}     
                              <button type="submit" class="btn btn-danger delete btn-sm "><i class="fa fa-trash"></i></button>
                           </form><!-- end of form -->  

                          @endif 

                        </div>
						
                      </td>
                    </tr>

                    @endforeach
                  </tbody>
                </table>
                <div class="row">

                  @else
                        <div  style="margin: 10%"> 
                        <h2> no client found in this page </h2>
                        </div>
                @endif

                  
                  <div class="col-12 d-flex justify-content-center ">

                   {{ $clients->appends(request()->query())->links() }}

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