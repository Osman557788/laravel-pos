@extends('dashboard.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">           
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">create product</h1> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">create product</li>
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
                            <!-- form start -->
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{route('dashboard.product.store')}}">

                                @include('partials._errors')

                                @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">product name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="product name">
                                </div>
                                </div>

                                <div class="form-group row">
                                  <label for="inputEmail3" class="col-sm-3 col-form-label">product description</label>
                                  <div class="col-sm-9">
                                      <input type="text" name="description" value="{{old('description')}}" class="form-control"  placeholder="product description">
                                  </div>
                                  </div>


                                <div class="form-group row">
                                    <label class="col-sm-3">category</label>
                                    <div class="col-sm-9">
                                    <select name="catgorie_id" class="form-control">
                                        <option value="">  categories </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">product image</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image" class="form-control" id="inputEmail3" placeholder="image">
                                </div>
                                </div> 
                                <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label"> purchase price </label>
                                <div class="col-sm-9">
                                    <input type="texte" name="purchase_price" class="form-control" id="inputEmail3" placeholder="purchase_price">
                                </div>
                                </div> 
                                <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">sale price</label>
                                <div class="col-sm-9">
                                    <input type="number" name="sale_price" class="form-control" id="inputEmail3" placeholder="sale price">
                                </div>
                                </div> 
                                <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label"> stock</label>
                                <div class="col-sm-9">
                                    <input type="number" name="stock" class="form-control" id="inputEmail3" placeholder="stock">
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