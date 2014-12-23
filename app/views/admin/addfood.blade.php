@include('master.header')
<form role="form" method="post" action="/admin/food/add">
    <input type="hidden" name="id">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" class="form-control" id="name" name="name" placeholder="Food">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" id="description" class="form-control" id="description" name="description" placeholder="Description">
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
                <input type="checkbox" name="allowed"> Allowed on the Slow Carb Diet?
            </label>
        </div>
    </div>
    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="allowed-in-moderation"> Allowed In Moderation on the Slow Carb Diet?
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-default">Save</button>
</form>
@include('master.footer')