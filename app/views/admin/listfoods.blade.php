@include('master.header')
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
    <div>
        <a href="/admin/food/add">Add Food</a>
    </div>

@include('master.footer')