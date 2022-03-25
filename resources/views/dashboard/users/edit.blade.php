@extends('dashboard.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">           
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">create Supervisor</h1> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">create Supervisor</li>
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
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{route('dashboard.user.update',$user->id)}}">
                                
                           

                              
                              @csrf
                                @method('put')
                            <div class="card-body">
                                <div class="form-group row">
                                      
                                 <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                       <div class="col-sm-10">
                                           <input type="email" name="email" class="form-control" id="inputEmail3" value="{{$user->email}}" placeholder="Email" >
                                       </div>

                                </div> 

                                <div class="form-group row">
                                    <label for="inputText3" class="col-sm-2 col-form-label">first name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="first_name" class="form-control" id="inputEmail3" value="{{$user->first_name}}" placeholder="first name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">last name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="last_name" class="form-control" id="inputEmail3" value="{{$user->last_name}}" placeholder="last name">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                  <label for="inputPassword3" class="col-sm-2 col-form-label">image</label>
                                  <div class="col-sm-10">
                                      <input type="file" name="image" class="form-control" id="inputPassword3">
                                  </div>
                                  </div>

                                <div class="form-group">
                                  <label>permissions</label>
                                  <div class="nav-tabs-custom">
      
                                      @php
                                          $models = ['users', 'categories', 'products', 'clients', 'orders'];
                                          $maps = ['create', 'read', 'update', 'delete'];
                                      @endphp
      
                                      <ul class="nav nav-tabs row"> 
                                          @foreach ($models as $index=>$model)
                                              <li class="{{ $index == 0 ? 'active' : '' }} col-lg-2" ><a href="#{{ $model }}" data-toggle="tab"> {{ $model }}</a></li>
                                          @endforeach
                                      </ul>
      
                                      <div class="tab-content">
      
                                          @foreach ($models as $index=>$model)
      
                                              <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">
      
                                                  @foreach ($maps as $map)
                                                      <label><input type="checkbox" {{ $user->hasPermission($model . '-' . $map) ? 'checked' : '' }} name="permissions[]" value="{{ $model . '-' . $map }}"> {{ $map}}</label>
                                                  @endforeach
      
                                              </div>
      
                                          @endforeach 
      
                                      </div><!-- end of tab content -->
                                      
                                  </div><!-- end of nav tabs -->
                                  
                              </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Sign in</button>
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