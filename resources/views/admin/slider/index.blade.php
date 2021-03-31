@extends('admin.admin_master')

@section('admin')

  <div class="py-12">
    
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex justify-content-between">
          <h4>Home Slider</h4>
          <a href="">
            <button class="btn btn-success btn-md">Add</button>
          </a>
        </div>
        <div class="col-12">
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-sm-9">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="card">
                <!-- <div class="card-header">
                  All Slider
                </div> -->
                <div class="card-body">
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">SL</th>
                          <th scope="col">Title</th>
                          <th scope="col">Description</th>
                          <th scope="col">Image</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          <!-- @php($i = 1) -->
                          @foreach($sliders as $slider)
                              <tr>
                                  <!-- <th scope="row">{{ $i++ }}</th> -->
                                  <th scope="row">{{ $sliders->firstItem()+$loop->index }}</th>
                                  <td>{{$slider->title}}</td>
                                  <td>{{$slider->description}}</td>
                                  <td>
                                    <img class='w-50' src='{{ $slider->image }}' alt="{{ $slider->title }}" />
                                  </td>
                                  <td>{{ Carbon\Carbon::parse($slider->created_at)->diffForHumans()}}</td>
                                  <td>
                                    <a href="{{ url('brand/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('brand/delete/'.$slider->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-danger">Delete</a>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
              <hr >
          </div>
        </div>
        <!-- <div class="col-12 col-sm-3">
          <div class="card">
            <div class="card-header">
              Add Brand
            </div>
            <div class="card-body">
              <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name">
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="file" class="form-control" name="logo" id="logo">
                  @error('logo')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <button type="submit" class="btn btn-success">Save</button>
              </form>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
@endsection