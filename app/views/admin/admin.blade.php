@include('master.header')

<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-10 margin-top">
        @if (Session::has('auth_error'))
            {{ Session::get('auth_error') }}
        @endif
        <h3>Welcome {{ Auth::user()->username }}</h3>
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-10 margin-top">
            <a href="/admin/food/add" class="btn btn-dark">Add Food</a>
            <a href="/admin/food/list" class="btn btn-dark">List Food</a>
        </div>
    </div>
</div>
@include('master.footer')