@include('home.header')
<div class="container">
    {{ Form::open(['url' => '/search', 'method' => 'post', 'class' => 'searchform', 'role' => 'form']) }}
    <div class="form-group">
        {{ Form::text('food', '', ['class' => 'form-control input', 'id' => 'food', 'placeholder' => 'Enter Food' ]) }}
    </div>
    {{ Form::close() }}
    
    <div id="results" class="alert alert-info">
        <strong>{{ $food_name }} </strong> {{ $is_isnot }} allowed on the Slow Carb Diet
    </div>
    
    @if($similar_food != null)
    <p>Did you mean <em><a href="#" id="similarfood">{{ $similar_food }}</a></em>?</p>
  @endif
</div> <!-- /container -->

@include('home.footer')