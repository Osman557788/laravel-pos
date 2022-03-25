@extends('dashboard.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">           
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">edit clien</h1> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">edit clien</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

     <div class="box box-primary">
        <div class="col-12 col-offset">
            <div class="card">
              <div class="card-header">
                 <div class="container-fluid">
                   <div class="row justify-content-md-center">
                                <!-- Horizontal Form -->
                        <div class=" col-md-7 card card-info">
                               @include('partials._errors')
                            <!-- form start -->
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{route('dashboard.client.update',$client->id)}}">
                                
                              @csrf
                              
                              @method('put')

                            <div class="card-body">

                              <div class="form-group row">    
                                <label for="inputEmail3" class="col-sm-2 col-form-label">name</label>
                                <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputEmail3" value="{{$client->name}}" placeholder="name" >
                                </div>
                              </div>
                                <div class="form-group row">    
                                  <label for="inputEmail3" class="col-sm-2 col-form-label">email</label>
                                  <div class="col-sm-10">
                                  <input type="email" name="email" class="form-control" id="inputEmail3" value="{{$client->email}}" placeholder="email" >
                                  </div>
                                </div>
                                <div class="form-group row">    
                                  <label for="inputEmail3" class="col-sm-2 col-form-label">phon number</label>
                                  <div class="col-sm-10">
                                  <input type="number" name="phon_number" class="form-control" id="inputEmail3" value="{{$client->phon_number}}" placeholder="phon number" >
                                  </div>
                                </div>
                               
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">add</button>
                            </div>
                            <!-- /.card-footer -->
                            </form>
                        </div>
                        <!-- /.card -->
            
                        </div>  


                    
                    </div> <!--end row--> 
                  </div> <!--end container-->
                 
              </div>
              <!-- /.card-header -->
              
            </div>
            <!-- /.card -->
          </div>
        </div>     
</div>
    
@endsection