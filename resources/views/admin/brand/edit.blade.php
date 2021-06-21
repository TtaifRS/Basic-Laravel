<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>Edit Brand</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Brand</div>
                        <div class="card-body">
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                            @endif
                            <form class="px-3" action="{{ url('/brand/update/' . $brands->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf 
                                <input type="hidden" name="old_image" value="{{$brands->brand_image}}">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="form-label">Update Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control mt-1"
                                        id="exampleInputEmail1" aria-describedby="emailHelp"
                                        value="{{ $brands->brand_name }}">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                


                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="form-label">Update Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control mt-1"
                                        id="exampleInputEmail1" aria-describedby="emailHelp"
                                        value="{{ $brands->brand_image }}">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <img src="{{asset($brands->brand_image)}}" style="width: 200px; height: 200px">
                                </div>

                                <button type="submit" class="btn btn-dark my-2">Update Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>