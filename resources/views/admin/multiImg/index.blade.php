<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>Multi Image</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-group">
                        @foreach($images as $image)
                            <div class="col-md-4 mt-5">
                                <div class="card mx-3">
                                    <img src="{{asset($image->image)}}" alt="">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Multi Image</div>
                        <div class="card-body">
                            <form class="px-3" action="{{route('store.image')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="form-label">Multi Image</label>
                                    <input type="file" name="multi_image[]" class="form-control mt-1"
                                        id="exampleInputEmail1" aria-describedby="emailHelp" multiple="true">
                                    @error('multi_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-dark my-2">Add Image</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
