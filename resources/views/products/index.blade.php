@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Список продуктов</h5><br>
            <a href="{{ route('products.create') }}" class="btn btn-success">Добавить продукт</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Артикул</th>
                    <th>Название</th>
                    <th>Статус</th>
                    <th>Цвет</th>
                    <th>Размер</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->article }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->status === 'available' ? 'Доступен' : 'Недоступен' }}</td>
                        @php
                            $data = json_decode($product->data, true); // Декодируем JSON в массив
                        @endphp
                        <td>{{ $data['color'] ?? 'Пусто' }}</td>
                        <td>{{ $data['size'] ?? 'Пусто' }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Редактировать</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
