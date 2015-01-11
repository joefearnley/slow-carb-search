@include('master.header')
<div class="container">

    <div class="row">
        <div class="col-md-offset-4 col-md-5 large-margin-top">
        @if (Session::has('login_error_message'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('login_error_message') }}
                {{ Session::get('auth_error') }}
            </div>
        @endif
            <form role="form" class="form" action="/admin/login" method="post">
                <div class="form-group">
                    <label for="Username"></label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password"></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
        <div class="col-md-offset-3 col-md-4">
    </div>
</div>
@include('master.footer')