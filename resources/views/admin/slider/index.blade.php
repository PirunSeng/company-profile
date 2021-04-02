@extends('admin.admin_master')

@section('admin')

  <div class="py-12">
    
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex justify-content-between">
          <h4>Home Slider</h4>
          <a href="{{ route('add.slider') }}">
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
        <div class="col-12">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <div class="card">
                <!-- <div class="card-header">
                  All Slider
                </div> -->
                <div class="card-body">
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col" width="5%">SL</th>
                          <th scope="col" width="15%">Title</th>
                          <th scope="col" width="15%">Description</th>
                          <th scope="col" width="15%">Image</th>
                          <th scope="col" width="15%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @php($i = 1)
                          @foreach($sliders as $slider)
                              <tr>
                                  <th scope="row">{{ $i++ }}</th>
                                  <td>{{$slider->title}}</td>
                                  <td>{{$slider->description}}</td>
                                  <td>
                                    <img class='w-50' src='{{ asset($slider->image) }}' alt="{{ $slider->title }}" />
                                  </td>
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
      </div>
    </div>
  </div>
@endsection