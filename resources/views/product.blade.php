@include('header')
@if ($product)
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Manufacture</th>
            <th scope="col">Release date</th>
            <th scope="col">Cost</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td>{{ $product->name }}</a></td>
            <td>{{ $product->manufacture }}</td>
            <td>{{ $product->releaseDate }}</td>
            <td>{{ $product->cost }}</td>
        </tr>

        </tbody>
    </table>
    <div>Description:</div>
    <div>{{$product->description}} </div>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Deadline</th>
            <th scope="col">Cost</th>
            <th scope="col">Add</th>
        </tr>
        </thead>
        <tbody>
        @foreach($services as $service)
            <tr>
                <td><a href="../services/{{ $service->id }}">{{ $service->name }}</a></td>
                <td>{{ $service->deadline }}</td>
                <td>{{ $service->cost }}</td>
                <td>
                    @if(!isset($service->isAdded))
                        <form class="btn btn-outline-success"
                              action="/services/{{ $service->id }}/addToServiceToProduct" method="post">
                            @method('put')
                            @csrf
                            <button>+</button>
                        </form>
                    @else
                        <form class="btn btn-outline-danger"
                              action="/services/{{ $service->id }}/deleteServiceFromProduct" method="post">
                            @method('put')
                            @csrf
                            <button>-</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <form class="btn btn-outline-success" action="{{$product->id}}/addToCart" method="post">
        @method("post")
        @csrf
        <button>Add to cart</button>
    </form>
@else
    <div>No such product</div>
@endif
@include('footer')
