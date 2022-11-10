@extends('layout.baseLayout')
@section('content')
    @if ($service)
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Deadline</th>
                <th scope="col">Cost</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td>{{ $service->name }}</a></td>
                <td>{{ $service->deadline }}</td>
                <td>{{ $service->cost }}</td>
            </tr>

            </tbody>
        </table>
    @else
        <div>No such service</div>
    @endif

@endsection

