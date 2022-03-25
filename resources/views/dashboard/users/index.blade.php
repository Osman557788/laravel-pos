@extends('dashboard.layout')


@section('content')


 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">           
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Supervisors</h1> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">devisors</li>
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
                      <form action="{{ route('dashboard.user.index') }}" method="get">

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
                         <a class="  btn btn-primary " href="{{url('dashboard/user/create')}}"> + add Supervisor </a>
                      </div>
                    </div>
                  </div>
                 
              </div>
              <!-- /.card-header -->

              @if ($users->count() > 0)

              <div id="deletes" class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>first name</th>
                      <th>last name</th>
                      <th>email</th>
                      <th>image</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>


                  	@foreach($users as $user)
                    <tr>
                      <td>{{$user->id}}</td>
                      <td>{{$user->first_name}}</td>
                      <td>{{$user->last_name}}</td>
                      <td><span class="tag tag-success">{{$user->email}}</span></td>
                      <td><img src="{{ asset('uploads/user_images/'.$user->image )}}" style="width: 100px"  class="img-thumbnail" alt=""></td>
                      <td>

                        <div class="second ">

                          @if(auth()->user()->haspermission('users-update'))
                          
                      	   <a class="btn btn-primary" href="{{ route('dashboard.user.edit', $user->id) }}"> <i class="fa fa-edit"></i> edit </a>    
                          
                          @endif
                          
                          @if(auth()->user()->haspermission('users-delete'))
                           <form  action="{{ route('dashboard.user.destroy', $user->id) }}" method="post" style="display: inline-block">
                             {{ csrf_field() }}
                             {{ method_field('delete') }}
                              <button type="submit" class="btn btn-danger delete btn-sm "><i class="fa fa-trash"></i> delete </button>
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
                        <div  style="margin: 5%"> 
                        <h2> no user found </h2>
                        </div>
              @endif

                  
                  <div class="col-12 d-flex justify-content-center ">

                   {{ $users->appends(request()->query())->links() }}

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