@include('master.header')
<div class="container">
    <div class="row">
        <div class="col-md-offset-2 col-md-10 margin-top">
            <a href="/admin" class="btn btn-dark">Admin Home</a>
            <a href="/admin/food/add" class="btn btn-dark">Add Food</a>
            <a href="/admin/food/list" class="btn btn-dark">List Food</a>
        </div>
    </div
    <div class="row">
        <div class="col-md-offset-2 col-md-10 large-margin-top">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th class="text-center">Allowed</th>
                    <th class="text-center">Allowed In Moderation</th>
                </tr>
                @foreach ($foods as $food)
                <tr>
                    <td><a href="/admin/food/edit/{{ $food->id }}">{{ $food->id }}</a></td>
                    <td><a href="/admin/food/edit/{{ $food->id }}">{{ $food->name }}</a></td>
                    <td>{{ $food->description }}</td>
                    <td class="text-center">{{ $food->getAllowedAsString() }}</td>
                    <td class="text-center">{{ $food->getAllowedInModerationAsString() }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@include('master.footer')