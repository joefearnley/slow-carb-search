@include('master.header')
    <div class="error">
        {{ $errors->first('food') }}
    </div>
    {{ Form::open(['url' => '/search', 'method' => 'post', 'class' => 'searchform', 'role' => 'form']) }}
    <div class="form-group">
        {{ Form::text('food', '', ['class' => 'form-control input-large', 'id' => 'food', 'placeholder' => 'Enter Food']) }}
    </div>
    {{ Form::close() }}
@include('master.footer')