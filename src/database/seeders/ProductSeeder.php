<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Season;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'キウイ',
                'price' => 800,
                'description' => 'キウイは甘みと酸味のバランスが絶妙なフルーツです。ビタミンCなどの栄養素も豊富のため、美肌効果や疲労回復効果も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'products/kiwi.png',
                'seasons' => ['秋', '冬'],
            ],
            [
                'name' => 'ストロベリー',
                'price' => 1200,
                'description' => '大人から子供まで大人気のストロベリー。当店では鮮度抜群の完熟いちごを使用しています。ビタミンCはもちろん食物繊維も豊富なため、腸内環境の改善も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'products/strawberry.png',
                'seasons' => ['春'],
            ],
            [
                'name' => 'オレンジ',
                'price' => 850,
                'description' => '当店では酸味と甘みのバランスが抜群のネーブルオレンジを使用しています。酸味は控えめで、甘さと濃厚な果汁が魅力の商品です。もぎたてフルーツのスムージをお召し上がりください！',
                'image' => 'products/orange.png',
                'seasons' => ['冬'],
            ],
            [
                'name' => 'スイカ',
                'price' => 700,
                'description' => '甘くてシャリシャリ食感が魅力のスイカ。全体の90％が水分のため、暑い日の水分補給や熱中症予防、カロリーが気になる方にもおすすめの商品です。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'products/watermelon.png',
                'seasons' => ['夏'],
            ],
            [
                'name' => 'ピーチ',
                'price' => 1000,
                'description' => '豊潤な香りととろけるような甘さが魅力のピーチ。美味しさはもちろん見た目の可愛さも抜群の商品です。ビタミンEが豊富なため、生活習慣病の予防にもおすすめです。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'products/peach.png',
                'seasons' => ['夏'],
            ],
            [
                'name' => 'シャインマスカット',
                'price' => 1400,
                'description' => '爽やかな香りと上品な甘みが特長的なシャインマスカットは大人気のフルーツ。疲れた脳や体のエネルギー補給にも最適です。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'products/muscat.png',
                'seasons' => ['夏', '秋'],
            ],
            [
                'name' => 'パイナップル',
                'price' => 800,
                'description' => '甘酸っぱさとトロピカルな香りが特徴のパイナップル。国産の甘さと酸味のバランスが絶妙なパイナップルを使用。もぎたてフルーツのスムージをお召し上がりください！',
                'image' => 'products/pineapple.png',
                'seasons' => ['春', '夏'],
            ],
            [
                'name' => 'ブドウ',
                'price' => 1100,
                'description' => '人気の高い国産「巨峰」を使用。高い糖度と適度な酸味、鮮やかなパープルが魅力。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'products/grapes.png',
                'seasons' => ['夏', '秋'],
            ],
            [
                'name' => 'バナナ',
                'price' => 600,
                'description' => '低カロリーで栄養満点。ダイエット中の方にもおすすめ。1杯で濃厚な甘みを堪能できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'products/banana.png',
                'seasons' => ['夏'],
            ],
            [
                'name' => 'メロン',
                'price' => 900,
                'description' => '香りがよくジューシーで品のある甘さ。カリウムが豊富でむくみ解消にも効果的。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'products/melon.png',
                'seasons' => ['春', '夏'],
            ],
        ];

        foreach ($products as $data) {
            $product = Product::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'description' => $data['description'],
                'image' => $data['image'],
            ]);

            $seasonIds = Season::whereIn('name', $data['seasons'])->pluck('id');
            $product->seasons()->attach($seasonIds);
        }
    }
}
