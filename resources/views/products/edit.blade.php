@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Редактировать продукт</div>
        <div class="card-body">
            <form method="POST" action="{{ route('products.update', $product->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="article">Артикул</label>
                    <input id="article" type="text" class="form-control" name="article" value="{{ $product->article }}" required>
                    @if ($errors->has('article'))
                        <span class="text-danger">{{ $errors->first('article') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">Название продукта</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                </div>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <div class="form-group">
                    <label for="status">Статус</label>
                    <select id="status" class="form-control" name="status" required>
                        <option value="available" {{ $product->status == 'available' ? 'selected' : '' }}>Доступен</option>
                        <option value="unavailable" {{ $product->status == 'unavailable' ? 'selected' : '' }}>Недоступен</option>
                    </select>
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="data">Дополнительные данные (JSON)</label>--}}
{{--                    <textarea id="data" class="form-control" name="data" required>{{ $product->data }}</textarea>--}}
{{--                </div>--}}
                @php
                    $data = json_decode($product->data, true); // Декодируем JSON в массив
                @endphp
                <div>
                    <label for="color">Цвет:</label>
                    <input type="text" name="color" id="color" class="form-control" value="{{ $data['color'] }}">
                    @if ($errors->has('color'))
                        <span class="text-danger">{{ $errors->first('color') }}</span>
                    @endif
                </div>

                <div>
                    <label for="size">Размер:</label>
                    <input type="text" name="size" id="size" class="form-control" value="{{ $data['size'] }}">
                    @if ($errors->has('size'))
                        <span class="text-danger">{{ $errors->first('size') }}</span>
                    @endif
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Обновить продукт</button>
            </form>
        </div>
    </div>
@endsection
