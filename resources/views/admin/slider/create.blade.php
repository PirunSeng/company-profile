@extends('admin.admin_master')

@section('admin')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          Add Slider
        </div>
        <div class="card-body">
          <form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" name="title" id="title">
              @error('title')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" name="description" id="description"></textarea>
              @error('description')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <input type="file" class="form-control" name="image" id="image">
              @error('image')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <button type="submit" class="btn btn-success">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection