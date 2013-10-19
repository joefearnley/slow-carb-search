@section('content')
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
            <td><a href="/admin/food/edit/{{ $food->getId() }}">{{ $food->getId() }}</a></td>
            <td><a href="/admin/food/edit/{{ $food->getId() }}">{{ $food->getName() }}</a></td>
            <td>{{ $food->getDescription() }}</td>
            <td class="text-center">{{ $food->getAllowedAsString() }}</td>
            <td class="text-center">{{ $food->getAllowedInModerationAsString() }}</td>
        </tr>
        @endforeach
    </table>
    <div>
        <a href="/admin/food/add">Add Food</a>
    </div>
@endsection