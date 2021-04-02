@extends('admin.admin_master')

@section('admin')
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          Add About
        </div>
        <div class="card-body">
          <form action="{{ route('store.about') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" name="title" id="title">
              @error('title')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="short_description">Short Description</label>
              <textarea class="form-control" name="short_description" id="short_description"></textarea>
              @error('short_description')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="long_description">Long Description</label>
              <textarea class="form-control" name="long_description" id="long_description"></textarea>
              @error('long_description')
                <span class="text-danger">{{ $long_description }}</span>
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