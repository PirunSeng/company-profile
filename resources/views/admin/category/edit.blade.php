<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          All Category
      </h2>
  </x-slot>

  <div class="py-12">
    
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-9">
          <div class="card">
            <div class="card-header">
              Edit Category
            </div>
            <div class="card-body">
              <form action="{{ url('category/update/'.$category->id) }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}">
                  @error('name')
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
