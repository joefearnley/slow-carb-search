@include('master.header')
    @if (Session::has('login_error_message'))
    <div class="row">
        <div class="col-md-offset-4 error">
            {{ Session::get('login_error_message') }}
            {{ Session::get('auth_error') }}
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-offset-4">
            <form role="form" class="form login" action="/admin/login" method="post">
                <div class="form-group">
                    <label for="Username"></label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password"></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@include('master.footer')