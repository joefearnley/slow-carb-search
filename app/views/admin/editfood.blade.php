@section('content')
<form role="form" method="post" action="/admin/food/save">
    <input type="hidden" name="id" value="{{ $food->getId() }}">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="{{ $food->name }}" value="{{ $food->name }}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="{{ $food->description }}" value="{{ $food->description }}">
    </div>
    
    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="allowed" {{ $food->getAllowedChecked() }}> Allowed on the Slow Carb Diet?
            </label>
        </div>
    </div>

    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="allowed-in-moderation" {{ $food->getAllowedInModerationChecked() }}> Allowed In Moderation on the Slow Carb Diet?
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-default">Save</button>
</form>
@endsection