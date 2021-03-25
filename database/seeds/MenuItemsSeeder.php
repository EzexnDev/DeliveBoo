<?php

use Illuminate\Database\Seeder;
use App\MenuItem;
use App\Restaurant;
use Faker\Generator as Faker;

class MenuItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // factory(MenuItem::class,200)->create();
        $restaurants = Restaurant::all();
       
        $pizzas = ['Margherita', 'Marinara', '4 Formaggi', 'Diavola', 'Lardo Miele Noci', '4 Stagioni', 'Parigina'];
        $pastas = ['Pasta alla Norma', 'Fusilli al pesto', 'Spaghetti alla Carbonara', 'Fettuccinine alla bolognese', 'Cotoletta con Patatine', 'Panna Cotta', 'Tiramisù'];
        $burgers = ['Onion Burger', 'Gringo Burger', 'BBQ Burger', 'Ceasar Burger', 'Crispy bacon', 'Cheeseburger', 'Hamburger'];
        $cinese = ['Involtini Primavera', 'Pane Cinese', 'Ravioli di Gamberi', 'Riso alla Cantonese', 'Spaghetti di soia', 'Lumache alla soia', 'Pollo fritto'];
        $japs = ['Nigiri Sakè', 'Hosomaki Avocado', 'Gunkan Salmon', 'Temaki Maguro', 'Chirashi Misto', 'Giappo Roll', 'Mochi'];
        $indiano = ['Pesce Tikka', 'Dahl Soup', 'Tandoori Chicken', 'Agnello Biriany', 'Gamberoni Korma', 'Chicken Curry', 'Kheer'];
        $americas = ['Buffalo Wings', 'Barbecue Ribs', 'Chili Cheese Dog', 'Corn Dogs', 'Grilled Cheese', 'Juicy Lucy', 'Pancakes'];

        // DESCRIPTION
        $d_pizza = [
            'Fior di Latte, Pomodori pelati, Pecorino Romano DOP, Basilico, Olio Evo.',
            'Pomodori pelati, Aglio dell’Ufita, Origano di montagna, Basilico, Olio Evo.',
            'Fior di Latte, Gorgonzola, Fontina, Parmigiano, Olio Evo.',
            'Fior di Latte, Pomodori pelati, Salame Piccante, Olio Evo.',
            'Fior di Latte. Lardo, Miele, Noci, Olio Evo.',
            'Fior di Latte, Pomodori pelati, Olive Nere, Carciofini, Funghi, Prosciutto Cotto, Olio Evo.',
            'Fior Di Latte, Panna, Scaglie di Grana, Prosciutto Crudo, Olio Evo.'
        ];
        $d_pasta = [
            'Melanzane, Rcotta Salata, Pomodori Ramati, Olio Evo.',
            'Fusilli al pesto',
            'Uova, Guanciale',
            'Carne Trita, Passata di pomodoro',
            'Cotoletta di vitello con patatine fritte o al forno',
            'Panna cotta Cioccolato, Creme Caramel o Frutti Rossi',
            'Tiramisù'
        ];
        $d_burger = [
            'Hamburger di manzo 150gr, bacon, cheddar, salsa BBQ e anelli di cipolla',
            'Hamburger di manzo 150gr, bacon, cheddar, salsa BBQ e tacos',
            'Hamburger di manzo 150gr, insalata, cheddar, salsa BBQ a volontà',
            'Cotoletta di pollo, inslata, cheddar, salsa Ceasar',
            'Teneri pezzi di pollo fritti, inslata, salsa burger',
            'Hamburger di manzo 150gr, cheddar, Ketchup',
            'Hamburger di manzo 150gr, cheddar, insalata, pomodoro, ketchup'
        ];
        $d_japs = [
            'Riso bianco con Salmone',
            'Riso bianco con Avocado ed alga nori',
            'Riso bianco con Salmone',
            'Cono d alga nori con riso bianco e tonno',
            'Ciotola di riso bianco con salmone, tonno, branzino, gambero rosso',
            'Daikon, ananas, cetriolo, sweet chili sause',
            'Dolce di riso al te verde, fragola, cioccolato'
        ];
        $d_indiano = [
            'Bocconcini di pesce spada marinati in salsa di yogurt, coriandolo fresco e cotti nel forno tandoori',
            'Zuppa di lenticchie con curcuma e zenzero',
            'Cosce di pollo marinate in una salsa a base di spezie e yogurt e cotto in forno',
            'Spezzatino di agnello accompagna riso basmati speziato, la cottura avviene in forno',
            'Gamberoni con mandorle tostate',
            'Pollo al curry',
            'Budino di riso con bacche di cardamomo'
        ];
        $d_americas = [
            'Ali di pollo fritte',
            'Costine di maiale alla griglia in salsa barbecue',
            'Hot Dog ricoperto di chili, cheddar grattugiato e cipolle rosse',
            'Würstel infilzati negli stecchi di legno, ricoperti da una pastella di farina di mais',
            'Sandwich con burro e formaggio',
            "Hamburger con cuore di formaggio all'interno della carne che con il calore si fonde formando un nucleo fuso e filante",
            'Pancakes con sciroppo d acero'
        ];


        for ($i=0; $i < $restaurants->count(); $i++) {
            for ($j=0; $j < 7 ; $j++) {
                $new_item = new MenuItem();
                $new_item->restaurant_id = $i+1;
                if($i < 5){
                    $new_item->name = $pizzas[$j];
                    $new_item->description = $d_pizza[$j];
                } else if($i < 10){
                    $new_item->name = $pastas[$j];
                    $new_item->description = $d_pasta[$j];
                } else if($i < 15){
                    $new_item->name = $burgers[$j];
                    $new_item->description = $d_burger[$j];
                }else if($i < 20){
                    $new_item->name = $cinese[$j];
                    $new_item->description = $cinese[$j];
                }else if($i < 25){
                    $new_item->name = $japs[$j];
                    $new_item->description = $d_japs[$j];
                }else if($i < 30){
                    $new_item->name = $indiano[$j];
                    $new_item->description = $d_indiano[$j];
                }else{
                    $new_item->name = $americas[$j];
                    $new_item->description = $d_americas[$j];
                }
                // $new_item->name = $items[$i].' '.$faker->word();
                // $new_item->description = $faker->sentence();
                //$new_item->ingredients = $faker->word();
                $new_item->price = $faker->randomFloat($nbMaxDecimals = 2, $min = 5, $max = 20);
                $new_item->isActive = true;
                $new_item->isDeleted = false;
                
                $new_item->save();
            }
        }
    }
}
