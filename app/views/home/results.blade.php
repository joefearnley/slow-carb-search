@include('master.header')

    {{ Form::open(['url' => '/search', 'method' => 'post', 'class' => 'searchform', 'role' => 'form']) }}
    <div class="form-group">
        {{ Form::text('food', '', ['class' => 'form-control input', 'id' => 'food', 'placeholder' => 'Enter Food' ]) }}
    </div>
    {{ Form::close() }}

    <div id="results" class="alert alert-info">
        <strong>{{ $searchInput }} </strong> {{ $message }}
    </div>

    @if($similarFoodName != null)
    <p>Did you mean <em><a href="#" id="similarfood">{{ $similarFoodName }}</a></em>?</p>
    @endif

@include('master.footer')
