@include('master.header')

@if (Session::has('auth_error'))
<div class="row">
    <div class="col-md-offset-4 error">
        {{ Session::get('auth_error') }}
    </div>
</div>
@endif

<h3>Welcome user</h3>

<ul>
    <li><a href="admin/food/list">List Foods</a></li>
    <li><a href="admin/food/add">Add Food</a></li>
</ul>
@include('master.footer')