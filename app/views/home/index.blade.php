@section('content')
<div class="container">
  {{ Form::open(['url' => '/search', 'method' => 'post', 'class' => 'searchform', 'role' => 'form']) }}
  <div class="form-group">
    {{ Form::text('food', '', ['class' => 'form-control input', 'id' => 'food', 'placeholder' => 'Enter Food']) }}
  </div>
  {{ Form::close() }}
@endsection