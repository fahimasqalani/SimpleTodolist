@extends('dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Todo Tasks List</h3>

            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Operations</th>
                </tr>

                @forelse($tasks as $task)
                    <tr>
                        <td>{{ $task->getId() }}</td>
                        <td>{{ $task->getName() }}</td>
                        <td>{{ $task->getDescription() }}</td>
                        <td>
                            @if($task->isDone())
                                Done
                            @else
                                Not Done
                            @endif
                            - <a href="{{ url('toggle/' . $task->getId()) }}">Change</a>
                        </td>
                        <td>
                            <a href="{{ url('edit/' . $task->getId()) }}">Edit</a> |
                            <a href="{{ url('delete/' . $task->getId()) }}">Delete</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No tasks in the list... for now!</td>
                    </tr>
                @endforelse

                {{--<tr>--}}
                {{--<td>{{ $task->getId() }}</td>--}}
                {{--<td>{{ $task->getName() }}</td>--}}
                {{--<td>{{ $task->getDescription() }}</td>--}}
                {{--<td>--}}
                {{--@if($task->isDone())--}}
                {{--Done--}}
                {{--@else--}}
                {{--Not Done--}}
                {{--@endif--}}
                {{--- <a href="{{ url('toggle/' . $task->getId()) }}">Change</a>--}}
                {{--</td>--}}
                {{--<td>--}}
                {{--<a href="{{ url('edit/' . $task->getId()) }}">Edit</a> |--}}
                {{--<a href="{{ url('delete/' . $task->getId()) }}">Delete</a>--}}
                {{--</td>--}}
                {{--</tr>--}}
            </table>
        </div>
    </div>
@endsection
