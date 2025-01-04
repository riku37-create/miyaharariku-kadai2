<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productSeasons = [
            ['product_id' => 1, 'season_ids' => [3,4]], // キウイは秋、冬
            ['product_id' => 2, 'season_ids' => [1]], // ストロベリーは春
            ['product_id' => 3, 'season_ids' => [4]], // オレンジは冬
            ['product_id' => 4, 'season_ids' => [2]], // スイカは夏
            ['product_id' => 5, 'season_ids' => [2]], // ピーチは夏
            ['product_id' => 6, 'season_ids' => [2,3]], // シャインマスカットは夏、秋
            ['product_id' => 7, 'season_ids' => [1,2]], // パイナップルは春、夏
            ['product_id' => 8, 'season_ids' => [2,3]], // ブドウは夏、秋
            ['product_id' => 9, 'season_ids' => [2]], // バナナは夏
            ['product_id' => 10, 'season_ids' => [1,2]], // メロンは春、夏
        ];

        foreach ($productSeasons as $productSeason) {
            foreach ($productSeason['season_ids'] as $season_id) {
                DB::table('product_season')->insert([
                    'product_id' => $productSeason['product_id'],
                    'season_id' => $season_id,
                ]);
            }
        }
    }
}
