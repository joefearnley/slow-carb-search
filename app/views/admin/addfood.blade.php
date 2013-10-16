@section('content')
<form role="form" method="post" action="/admin/food/add">
  <input type="hidden" name="id">
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Food">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Description</label>
    <input type="text" class="form-control" id="description" name="description" placeholder="Description">
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
@endsection