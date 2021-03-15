<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          All Brand
      </h2>
  </x-slot>

  <div class="py-12">
    
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-9">
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>{{session('success')}}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          <div class="card">
            <div class="card-header">
              Edit Brand
            </div>
            <div class="card-body">
              <form action="{{ url('brand/update/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="old_logo" value="{{ $brand->logo }}" />
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $brand->name }}">
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="file" class="form-control" name="logo" id="logo" value="{{ $brand->logo }}">
                  @error('logo')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <img class='w-50' src='{{ asset($brand->logo) }}' alt='brand logo' />
                <button type="submit" class="btn btn-success">Update</button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</x-app-layout>
