@extends('layouts.app')
@section('content')
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Manufacture</th>
            <th scope="col">Release date</th>
            <th scope="col">Services</th>
            <th scope="col">Cost</th>
            <th scope="col">Cost with services</th>
            <th scope="col">Delete from cart</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($products as $product)

            <tr>
                <td><a href="{{route('productsShow', $product->id)}}">{{ $product->name }}</a></td>
                <td>{{ $product->manufacture }}</td>
                <td>{{ $product->releaseDate }}</td>
                <td>
                    @foreach($product->services as $service)
                        <div>{{$service->name}} {{$service->cost}}</div>
                    @endforeach
                </td>
                <td>{{ $product->cost }}</td>
                <td>{{ $product->totalCost }}</td>
                <td>
                    <form class="btn btn-outline-danger" action="{{route('cartDestroy', $product->id)}}"
                          method="post">
                        @method("delete")
                        @csrf
                        <button>Delete from cart</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>Total cost {{ $totalCost }}</div>
@endsection
