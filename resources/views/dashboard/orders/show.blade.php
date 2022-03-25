
    <table class="table table-hover table-bordered">

        <thead>
            <tr>
                <th>الاسم</th>
                <th>الكميه</th>
                <th>السعر</th>
            </tr>
        </thead>

        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->pivot->quntity}}</td>
                <td>{{ number_format($product->pivot->quntity * $product->sale_price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>toatal <span>{{ number_format($order->total_price, 2) }}</span></h3>