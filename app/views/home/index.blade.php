@include('home.header')
<div class="container">
    <div class="error">
        {{ $errors->first('food') }}
    </div>
    {{ Form::open(['url' => '/search', 'method' => 'post', 'class' => 'searchform', 'role' => 'form']) }}
    <div class="form-group">
        {{ Form::text('food', '', ['class' => 'form-control input', 'id' => 'food', 'placeholder' => 'Enter Food']) }}
    </div>
    {{ Form::close() }}
</div> <!-- /container -->
@include('home.footer')