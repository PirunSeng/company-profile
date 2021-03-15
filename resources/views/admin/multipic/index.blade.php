<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          All Multipic
      </h2>
  </x-slot>

  <div class="py-12">
    
    <div class="container">
      <div class="row">
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
                <div class="card-header">
                  All Multipic
                </div>
                <div class="card-body">
                  <div class="row">
                    @foreach($multipics as $multipic)
                      <div class="col-2">
                        <img class="w-100" src="{{ asset($multipic->image) }}" alt="" />
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <hr >
          </div>
        </div>
        <div class="col-12 col-sm-3">
          <div class="card">
            <div class="card-header">
              Add Multipic
            </div>
            <div class="card-body">
              <form action="{{ route('store.multipic') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <input type="file" class="form-control" name="image[]" id="image" multiple="">
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
  </div>
</x-app-layout>
