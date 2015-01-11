@include('master.header')
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-10 large-margin-top">
            <form role="form" method="post" action="/admin/food/save">
                <input type="hidden" name="id" value="{{ $food->id }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="{{ $food->name }}" value="{{ $food->name }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="{{ $food->description }}" value="{{ $food->description }}">
                </div>
                <div class="form-group">
                    <label for="food-group">Food Group</label>                
                    <select class="form-control" name="food-group">
                        <option value="">Choose a Food Group</option>
                        @foreach ($foodGroups as $foodGroup)
                            <option value="{{ $foodGroup->id }}">{{ $foodGroup->name }}</option>
                        @endforeach
                    </select>
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
                <button type="submit" class="btn btn-dark">Save</button>
                <button id="cancel-edit" class="btn btn-dark">Cancel</button>
            </form>
        </div>
    </div>
</div>
@include('master.footer')