@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Добавить продукт</div>
        <div class="card-body">
            <form method="POST" action="{{ route('products.store') }}">
                @csrf
                <div class="form-group">
                    <label for="article">Артикул</label>
{{--                    <input id="article" type="text" class="form-control" name="article" required>--}}
                    <input type="text" name="article" id="article" class="form-control" value="{{ old('article') }}">
                    @if ($errors->has('article'))
                        <span class="text-danger">{{ $errors->first('article') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">Название продукта</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="status">Статус</label>
                    <select name="status" id="status" class="form-control">
                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                    @if ($errors->has('status'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="data">Дополнительные данные (JSON)</label>--}}
{{--                    <textarea name="data" id="data" class="form-control">{{ old('data') }}</textarea>--}}
{{--                    @if ($errors->has('data'))--}}
{{--                        <span class="text-danger">{{ $errors->first('data') }}</span>--}}
{{--                    @endif--}}
{{--                </div>--}}
                <div>
                    <label for="color">Цвет:</label>
                    <input type="text" name="color" id="color" class="form-control" value="{{ old('color') }}">
{{--                    <input type="text" name="color" id="color" required>--}}
                </div>

                <div>
                    <label for="size">Размер:</label>
                    <input type="text" name="size" id="size" class="form-control" value="{{ old('size') }}">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Добавить продукт</button>
            </form>
        </div>
    </div>
@endsection
