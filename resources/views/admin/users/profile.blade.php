<x-admin-master>
    @section('content')
        <h1>User Profile for: {{$user->name}}</h1>
        <div class="row">
            <div class="col-sm-6">
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <img width="60px" height="60px" src="https://source.unsplash.com/QAB-WJcbgJk/60x60" alt="" class="img-profile rounded-circle mb-1">
                    </div>
                    <div class="form-group">
                        <input type="file">
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Password confirmation</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>
