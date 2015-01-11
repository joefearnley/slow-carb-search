@include('master.header')
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-10 margin-top">
            <a href="/admin" class="btn btn-dark">Admin Home</a>
            <a href="/admin/food/add" class="btn btn-dark">Add Food</a>
            <a href="/admin/food/list" class="btn btn-dark">List Food</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-10 large-margin-top">
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
                <button type="submit" class="btn btn-dark">Save</button>
                <button id="cancel-edit" class="btn btn-dark">Cancel</button>
            </form>  
        </div>
    </div>
</div>
@include('master.footer')