@extends('layouts.app')
@section('content')
    <form class="user-form" action="/services" method="post">
        @csrf
        <caption>Service add form</caption>
        <div class="form-group form-element">
            <label for="name">Name</label>
            <input name="name" type="text" id="name">
        </div>
        @if($errors->has('name'))
            <div class="error">{{ $errors->first('name') }}</div>
        @endif

        <div class="form-group form-element">
            <label for="deadline">Deadline</label>
            <input name="deadline" type="text" id="deadline">
        </div>
        @if($errors->has('deadline'))
            <div class="error">{{ $errors->first('deadline') }}</div>
        @endif
        <div class="form-group form-element">
            <label for="cost">Cost</label>
            <input name="cost" type="text" id="cost">
        </div>
        @if($errors->has('cost'))
            <div class="error">{{ $errors->first('cost') }}</div>
        @endif
        <button id="addServiceButton" class="btn btn-primary" >Add service</button>
    </form>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Deadline</th>
            <th scope="col">Cost</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($services as $service)
            <tr>
                <td><a href="{{route('servicesShow', $service->id)}}">{{$service->name}}</a></td>
                <td>{{ $service->deadline }}</td>
                <td>{{ $service->cost }}</td>
                <td>
                    <a class="btn btn-outline-dark" href="{{route('servicesEdit', $service->id)}}">Update</a>
                </td>
                <td>
                    <form action="{{route('servicesDestroy', $service->id)}}" method="post">
                        <input class="btn btn btn-outline-danger" type="submit" value="Delete" />
                        @method('delete')
                        @csrf
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
