<x-admin-master>

    @section('content')
        <h1>All Posts</h1>
        @if(Session::has('message'))

            <div class="alert alert-danger text-center">{{Session::get('message')}}</div>

        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Ttile</th>
                    <th>Image</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Delete</th>
                </tr>
                </thead>
{{--                <tfoot>--}}
{{--                <tr>--}}
{{--                    <th>Id</th>--}}
{{--                    <th>Name</th>--}}
{{--                    <th>Position</th>--}}
{{--                    <th>Office</th>--}}
{{--                    <th>Age</th>--}}
{{--                    <th>Start date</th>--}}
{{--                </tr>--}}
{{--                </tfoot>--}}
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->title}}</td>
                        <td>
                            <img height="40px" src="{{$post->post_image}}" alt="">

                        </td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                        <td>
                            <form method="post" action="{{route('post.delete', $post->id)}}">
                                @csrf
                                @method('DELETE')


                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endsection

    @section('scripts')

            <!-- Page level plugins -->
            <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

            <!-- Page level custom scripts -->
            <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

        @endsection

</x-admin-master>
