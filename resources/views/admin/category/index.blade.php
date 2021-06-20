<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b>All Category</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <table class="table table-dark table-striped">
                    <thead>
                      <tr>
                        <th scope="col">SL No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created At</th>
                      </tr>
                    </thead>
                    <tbody>
                  
                        <tr>
                          <th scope="row"></th>
                          <td></td>
                          <td></td>
                          <td></td>
                          {{-- Query builder --}}
                          {{-- <td>{{Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td> --}}
                        </tr>
                      
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</x-app-layout>
