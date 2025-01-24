<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class SendProductWebhook extends Command
{
    protected $signature = 'products:send-webhook';
    protected $description = 'Отправляет информацию о продукте с наибольшим ID на указанный вебхук';

    public function handle()
    {
        $webhookUrl = config('product.webhook');

        $product = Product::orderBy('id', 'desc')->first();

        if ($product) {
            $data = [
                'id' => $product->id,
                'article ' => $product->article ,
                'name' => $product->name,
                'status' => $product->status,
                'data' => $product->data,
            ];

            $response = Http::post($webhookUrl, $data);

            if ($response->successful()) {
                $this->info('Успешно отправлено: ' . $product->id);
            } else {
                $this->error('Ошибка при отправке: ' . $response->status());
            }
        } else {
            $this->info('Нет доступных продуктов.');
        }
    }
}
