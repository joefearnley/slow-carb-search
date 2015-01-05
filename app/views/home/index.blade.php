@include('master.header')
    <header id="top" class="header">
        <div class="text-vertical-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-lg-offset-2">
                        {{ Form::open(['url' => '/', 'method' => 'get', 'class' => 'searchform', 'id' => 'searchform', 'role' => 'form']) }}
                            <div class="form-group">
                                {{ Form::text('food', $input, ['class' => 'form-control input-large', 'id' => 'food', 'placeholder' => 'Slow Carb Search']) }}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
                @if(!empty($results))
                <div class="row">
                    <div class="col-lg-9 col-lg-offset-2">
                        <div class="info">
                            @if($results->getFood()->allowed)
                                <strong>
                                    <span id="input">
                                        {{ $results->getSearchInput() }}
                                    </span>
                                </strong>
                                is allowed on the Slow Carb Diet
                            @else
                                <strong>
                                    <span id="input">
                                        {{ $results->getSearchInput() }}
                                    </span>
                                </strong> 
                                is not allowed on the Slow Carb Diet
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </header>
@include('master.about')
@include('master.footer')