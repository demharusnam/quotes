<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AvgPPS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AvgPPS';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates average price of item per state from ap_copi.sql. ap_copi.sql must be registered in database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('ap_copi')
            ->selectRaw('
                state,
                ROUND(AVG(steak),2) AS steak,
                ROUND(AVG(grnd_beef),2) AS grnd_beef,
                ROUND(AVG(sausage),2)  AS sausage,
                ROUND(AVG(fry_chick),2) AS fry_chicken,
                ROUND(AVG(tuna),2) AS tuna,
                ROUND(AVG(hgal_milk),2) AS hgal_milk,
                ROUND(AVG(dozen_eggs),2) AS dozen_eggs,
                ROUND(AVG(margarine),2) AS margarine,
                ROUND(AVG(parmesan),2) AS parmesan,
                ROUND(AVG(potatoes),2) AS potatoes,
                ROUND(AVG(bananas),2) AS bananas,
                ROUND(AVG(lettuce),2) AS lettuce,
                ROUND(AVG(bread),2) AS bread,
                ROUND(AVG(orange_juice),2) AS orange_juice,
                ROUND(AVG(coffee),2) AS coffee,
                ROUND(AVG(sugar),2) AS sugar,
                ROUND(AVG(cereal),2) AS cereal,
                ROUND(AVG(sweet_peas),2) AS sweet_peas,
                ROUND(AVG(peaches),2) AS peaches,
                ROUND(AVG(cooking_oil),2) AS cooking_oil,
                ROUND(AVG(frozn_meal),2) AS frozn_meal,
                ROUND(AVG(frozn_corn),2) AS frozn_corn,
                ROUND(AVG(potato_chips),2) AS potato_chips,
                ROUND(AVG(coke),2) AS coke,
                ROUND(AVG(hmbgr_sand),2) AS hmbgr_sand,
                ROUND(AVG(pizza),2) AS pizza,
                ROUND(AVG(2_pc_chick),2) AS two_pc_chick,
                ROUND(AVG(beer),2) AS beer,
                ROUND(AVG(wine),2) AS wine
            ')
            ->whereRaw('state_id IS NOT NULL AND state_id != 10')
            ->groupBy('state')
            ->orderBy('state')
            ->chunk(50, function ($states) {
                foreach ($states as $state) {
                    echo "$state->state: Steak ($$state->steak) Ground Beef ($$state->grnd_beef) Sausage ($$state->sausage) Fried Chicken ($$state->fry_chicken) Tuna ($$state->tuna) Half Gallon Milk ($$state->hgal_milk) Dozen Eggs ($$state->dozen_eggs) Margarine ($$state->margarine) Parmesan ($$state->parmesan) Potatoes ($$state->potatoes) Bananas ($$state->bananas) Lettuce ($$state->lettuce) Bread ($$state->bread) Orange Juice ($$state->orange_juice) Coffee ($$state->coffee) Sugar ($$state->sugar) Cereal ($$state->cereal) Sweet Peas ($$state->sweet_peas) Peaches ($$state->peaches) Cooking Oil ($$state->cooking_oil) Frozen Meal ($$state->frozn_meal) Frozen Corn ($$state->frozn_corn) Potato Chips ($$state->potato_chips) Coke ($$state->coke) Hamburger ($$state->hmbgr_sand) Pizza ($$state->pizza) Two-Piece Chicken ($$state->two_pc_chick) Beer ($$state->beer) Wine ($$state->wine)\n\n";
                }
            });
    }
}
