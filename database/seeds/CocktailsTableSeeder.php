<?php

use Illuminate\Database\Seeder;

class CocktailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cocktails')->insert([
            ['name' => 'Mojito',
            'alcohol_degree' => '40',
            'recipe' => "Dans un verre à Mojito, disposez 6 à 8 feuilles de menthe, 1/2 citron vert coupé en dés et 2 cl de sirop de canne.
                          Pilez et versez 4 cl de rhum blanc 40°.
                          Ajoutez de la glace pilée et allongez d’eau gazeuse.
                          Mélangez de bas en haut avec une cuillère à mélange."],
            ['name' => 'Pina Colada',
            'alcohol_degree' => '40',
            'recipe' => "Dans un shaker, versez les ingrédients.
                          Secouez énergiquement. Enfin, servez dans un grand verre sur des glaçons.
                          Astuce: Vous pouvez remplacer le jus d’ananas et le lait de coco par 12 cl de Piña Colada Caraïbos."],
            ['name' => 'Caïpirinha',
            'alcohol_degree' => '40',
            'recipe' => "Préparez la caïpirinha directement dans un verre.
                          Lavez le citron vert et découpez-le en dés, en supprimant la partie blanche centrale.
                          Placez les morceaux de citron dans le verre, ajoutez le sirop de canne et écrasez le tout à l’aide d’un pilon pour extraire le jus du citron vert.
                          Ajoutez la glace pilée puis versez la cachaça.
                          Mélangez avec un agitateur puis servez avec une paille."],
            ['name' => 'Margarita',
            'alcohol_degree' => '38',
            'recipe' => "Dans un shaker rempli à moitié de glaçons, versez 4 cl de tequila, 2 cl de triple sec et 2 cl de jus de citron vert.
                          Shakez et versez dans un verre à cocktail."],
            ['name' => 'Sex on the beach',
            'alcohol_degree' => '40',
            'recipe' => "Dans un verre tulipe, versez la vodka, la liqueur et la crème sur les glaçons et mélangez.
                          Versez ensuite les jus, mélangez de nouveau, ajoutez une tranche d’ananas en décoration et vous pouvez servir."],
            ['name' => 'Metropolitan',
            'alcohol_degree' => '40',
            'recipe' => "Dans un shaker rempli à moitié de glaçons, versez 4 cl de vodka, 1 cl de triple sec, 4 cl de nectar de cranberry, pressez le dé de citron vert.
                          Shakez et filtrez dans un verre à cocktail.
                          Ajoutez le dé de citron vert pressé.
                          Vous pouvez également réaliser ce cocktail avec 4 cl de vodka, 12 cl de Cosmopolitan Caraïbos et un trait de citron vert."],
            ['name' => 'Hurricane',
            'alcohol_degree' => '45',
            'recipe' => "Mélangez tous les ingrédients au shaker avec de la glace.
                          Versez dans un verre hurricane sur glace.
                          Vous pouvez ajouter un trait de jus de citron pour un goût plus citronné."],
            ['name' => 'Daïquiri',
            'alcohol_degree' => '40',
            'recipe' => "Dans un verre à cocktail, mélangez les ingrédients.
                          Ajoutez les glaçons.
                          Dégustez-le avec une paille.
                          Astuce : Le daïquiri est également délicieux en remplaçant le rhum blanc par du rhum doré.
                          Vous pouvez également réaliser ce cocktail au shaker."],
            ['name' => 'Bikini',
            'alcohol_degree' => '40',
            'recipe' => "Dans un shaker rempli de glaçons, versez 4 cl de vodka, 2 cl de rhum blanc, 1 cl de lait, jus d’un demi citron et une pincée de sel.
                          Shakez et versez dans un verre à cocktail."],
            ['name' => 'Blood and Sand',
            'alcohol_degree' => '40',
            'recipe' => "Mélangez tous les ingrédients au shaker avec de la glace. Versez dans un verre à cocktail en retenant les glaçons."],
            ['name' => 'Oolong Cha',
            'alcohol_degree' => '100',
            'recipe' => "Remplissez à 90% un verre de vodka. Ajouter du whiskey pour remplir les 10% restants."]
        ]);
    }
}
