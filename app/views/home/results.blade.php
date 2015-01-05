@include('master.header')

    {{ Form::open(['url' => '/search', 'method' => 'post', 'class' => 'searchform', 'role' => 'form']) }}
    <div class="form-group">
        {{ Form::text('food', '', ['class' => 'form-control input-large', 'id' => 'food', 'placeholder' => 'Enter Food' ]) }}
    </div>
    {{ Form::close() }}

    <div id="results" class="alert alert-info">
        <strong><span id="input">{{ $results->getSearchInput() }} </span></strong> 
        @if(!empty($results->getSimilarFoodName()))
            <span id="message"></span>
        @else
            <span id="message">{{ $results->getMessage() }}</span>
        @endif
    </div>

    @if(!empty($results->getSimilarFoodName()))
    <p>Did you mean <em><a href="#" id="similar-food">{{ $results->getSimilarFoodName() }}</a></em>?</p>
    @endif

@include('master.footer')