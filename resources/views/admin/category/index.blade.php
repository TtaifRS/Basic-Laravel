<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>All Category</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                        @endif

                        <div class="card-header">
                            All Category
                        </div>
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->user->name }}</td>
                                        <td>{{ $category->created_at->diffForHumans() }}</td>
                                        {{-- Query builder --}}
                                        {{-- <td>{{Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td> --}}
                                        <td>
                                            <a href="{{ url('category/edit/' . $category->id) }}"
                                                class="btn btn-info">Edit</a>
                                            <a href="{{ url('category/softdelete/' . $category->id) }}"
                                                class="btn btn-danger">Remove</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">
                            <form class="px-3" action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                    <input type="text" name="category_name" class="form-control mt-1"
                                        id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-dark my-2">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>




        {{-- Trash Part --}}
        <div class="container mt-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Trashed Data
                        </div>
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($trashCats as $trashCat)
                                    <tr>
                                        <th scope="row">{{ $trashCats->firstItem() + $loop->index }}</th>
                                        <td>{{ $trashCat->category_name }}</td>
                                        <td>{{ $trashCat->user->name }}</td>
                                        <td>{{ $trashCat->created_at->diffForHumans() }}</td>
                                        {{-- Query builder --}}
                                        {{-- <td>{{Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td> --}}
                                        <td>
                                            <a href="{{ url('category/restore/' . $trashCat->id) }}"
                                                class="btn btn-warning">Restore</a>
                                            <a href="{{ url('category/permanentDelete/' . $trashCat->id) }}"
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        {{ $trashCats->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
