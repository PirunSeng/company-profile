<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          All Category
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
            <!-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"> -->
              <div class="card">
                <div class="card-header">
                  All Category
                </div>
                <div class="card-body">
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Name</th>
                          <th scope="col">User</th>
                          <th scope="col">Created At</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          <!-- @php($i = 1) -->
                          @foreach($categories as $category)
                              <tr>
                                  <!-- <th scope="row">{{ $i++ }}</th> -->
                                  <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                  <td>{{$category->name}}</td>
                                  <td>{{$category->user->name}}</td>
                                  <td>{{ Carbon\Carbon::parse($category->created_at)->diffForHumans()}}</td>
                                  <td>
                                    <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('category/softDelete/'.$category->id) }}" class="btn btn-danger">Delete</a>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
              </div>
              <hr >

              <div class="card">
                <div class="card-header">
                  Trashed
                </div>
                <div class="card-body">
                  <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Name</th>
                          <th scope="col">User</th>
                          <th scope="col">Created At</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          <!-- @php($i = 1) -->
                          @foreach($trashed_categories as $category)
                              <tr>
                                  <!-- <th scope="row">{{ $i++ }}</th> -->
                                  <th scope="row">{{ $trashed_categories->firstItem()+$loop->index }}</th>
                                  <td>{{$category->name}}</td>
                                  <td>{{$category->user->name}}</td>
                                  <td>{{ Carbon\Carbon::parse($category->created_at)->diffForHumans()}}</td>
                                  <td>
                                    <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info">Restore</a>
                                    <a href="{{ url('category/delete/'.$category->id) }}" class="btn btn-info">Permanetly Delete</a>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                    {{ $trashed_categories->links() }}
                </div>
              </div>
          <!-- </div> -->
        </div>
        <div class="col-12 col-sm-3">
          <div class="card">
            <div class="card-header">
              Add Category
            </div>
            <div class="card-body">
              <form action="{{ route('store.category') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name">
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
