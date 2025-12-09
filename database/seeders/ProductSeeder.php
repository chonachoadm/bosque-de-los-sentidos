<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                "name" => "Memotoc",
                "description" =>
                "Una versión del Memotest priorizando la sensación a distintas texturas por sobre las imágenes.¡Ideal para personas no videntes o con visión reducida!",
                "price" => 35000,
                "image" => "mMgXl6VRqO4mLRtzIdmh8IaauvWjIeoiSmeCxT6a.webp",
                "stock" => 15,
            ],
            [
                "name" => "Panel de control",
                "description" =>
                "Un juguete sensorial que invita a explorar, aprender y divertirse. Estimula la motricidad fina, la atención y la creatividad en todas las infancias, siendo además un recurso muy valorado en ámbitos educativos y terapéuticos.",
                "price" => 50000,
                "image" => "ERkIJad0J9FU6gueZo8oQEimFYELqpWXMAhzwYt4.webp",
                "stock" => 10,
            ],
            [
                "name" => "Cubo mágico 3x3",
                "description" =>
                "El clásico cubo mágico con patrones de relieve para una experiencia táctil única.",
                "price" => 15000,
                "image" => "v3JPGn5oBOwYjqq5saeKwuDyuRwHmtDZytM7Hk8O.webp",
                "stock" => 0,
            ],
            [
                "name" => "Scrabble braille",
                "description" =>
                "El clásico juego de palabras en una edición inclusiva. Con fichas en relieve y sistema braille, todos pueden participar y disfrutar de la diversión de crear palabras en el tablero.",
                "price" => 48000,
                "image" => "pZsXhw7eq0qmyMuBGqWhR2cGuhWRHmLnJEWOu56z.webp",
                "stock" => 6,
            ],
            [
                "name" => "Feelings: El juego de las emociones",
                "description" =>
                "Un juego de mesa diseñado para trabajar la empatía y la comunicación emocional, ideal para infancias neurodivergentes y contextos educativos.",
                "price" => 25000,
                "image" => "E3nr4nwI6buq9nhmQfG5ckGGCUbjedVqrX05G85L.webp",
                "stock" => 0,
            ],
            [
                "name" => "Monopoly braille",
                "description" =>
                "El clásico juego de finanzas en una edición accesible, con tablero, cartas y billetes adaptados en braille y relieve.",
                "price" => 45000,
                "image" => "x5fawPqfCSmc6ojnA2JKJAsyrXanugroAwW78Z8I.webp",
                "stock" => 23,
            ],
            [
                "name" => "Uno braille",
                "description" =>
                "La versión inclusiva del clásico juego de cartas, con símbolos en relieve para que personas ciegas o con baja visión puedan jugar sin barreras.",
                "price" => 30000,
                "image" => "0H80ltkSecGV500Gporxx887u3cruFtZOgvwZ82F.webp",
                "stock" => 14,
            ],
            [
                "name" => "Kit de construcción Montessori",
                "description" =>
                "Este no es solo un juguete, es una herramienta de aprendizaje que fomenta el desarrollo integral de los niños a partir de los 3 años. Con piezas de madera de alta calidad, colores vibrantes y tornillos fáciles de manipular, tus hijos podrán construir una silla, un avión, un tren y un sinfín de figuras que su imaginación les permita.",
                "price" => 45000,
                "image" => "inNtqu3cOoaEGI6GImMl1JoRoHyMfYSV3enincEH.webp",
                "stock" => 14,
            ],
            [
                "name" => "Gusanito de madera",
                "description" =>
                "El eslabón de madera Classic World está formado por grandes cuentas de colores pastel. Piensa y haz tú mismo los giros más extraños con esta oruga de eslabones de madera! Hay un elástico resistente entre las cuentas. Tira una cuenta en una dirección diferente cada vez y ve si puedes crear las formas que desea",
                "price" => 23000,
                "image" => "dZWaXTMiCeaq5D4UrH0hUty71vJKTOZXh3pEM2iD.webp",
                "stock" => 3,
            ],
            [
                "name" => "Escalerita Montessori",
                "description" =>
                "Su formato y sus colores estimulan los sentidos. Favorece el movimiento. Desarolla la musculatura y promueve el desarrollo del equilibrio. Motiva la creatividad. Lo podrá utilizar como si fuera un puente, una casa, una cuna, un mostrador, ¡como se le ocurra!",
                "price" => 70000,
                "image" => "5T6sXDFrMgF0RVE2N1a5mkyzuTbDApS93Li7BLk8.webp",
                "stock" => 18,
            ],
            [
                "name" => "Laberinto de caracol",
                "description" =>
                "Un juguete didáctico que invita a jugar y aprender al mismo tiempo. Con su simpática forma de caracol y piezas de colores llamativos, estimula la motricidad fina, la concentración y la coordinación ojo-mano. Ideal para primeras infancias, combina diversión y desarrollo en cada movimiento.",
                "price" => 40000,
                "image" => "2NccIW4bnDPvOWILuNchVuZfTPJ3xZxguJbzPkbu.webp",
                "stock" => 20,
            ],
            [
                "name" => "Tabla de equilibrio",
                "description" =>
                "Es una herramienta inclusiva diseñada para acompañar el desarrollo motriz de infancias de diversas capacidades. Su diseño permite que sea utilizada por personas con diferentes habilidades, promoviendo la integración y el juego compartido.",
                "price" => 45000,
                "image" => "jDeOjPnKO2abElr3bjcln3DYTKUriDXR0MBe7ahA.webp",
                "stock" => 15,
            ],
            [
                "name" => "Bloques coloridos",
                "description" =>
                "Los bloques ayudan a los niños a desarrollar sus destrezas motoras (fina y gruesas). Hace que se vuelvan conscientes del espacio y de su relación con otros objetos. El juego de Bloques es uno de los juguetes que mas motiva la creatividad.",
                "price" => 25000,
                "image" => "DSEKFGQW7k6oqAE5DhJ1Q7ZPv9yQtUcqlxyewSnH.webp",
                "stock" => 5,
            ],
            [
                "name" => "Raspador de caimán Montessori",
                "description" =>
                "Un compañero de juego que combina diversión, aprendizaje y desarrollo sensorial en un solo juguete. Fabricado en madera de alta calidad, su diseño permite que los más pequeños lo arrastren fácilmente, mientras que el agradable sonido que produce al moverse estimula su curiosidad y fomenta el desarrollo auditivo. Perfecto para niñes a partir de 12 meses, este juguete promueve la motricidad, la coordinación y la creatividad, ofreciendo horas de juego seguro y lleno de descubrimientos.",
                "price" => 27000,
                "image" => "tmY2EMZhBr8YUamlsPf5ZCcjs6H6cg2oUHEnTANg.webp",
                "stock" => 8,
            ],
            [
                "name" => "Surtidor de formitas",
                "description" =>
                "Fomenta habilidades esenciales a través de actividades de clasificación y apilamiento, promoviendo el desarrollo cognitivo y al mismo tiempo haciendo que el aprendizaje sea divertido.",
                "price" => 30000,
                "image" => "86j5K5BM3tzEpEX8UYtcOnavLHkj9LzLpUX7ZRqZ.webp",
                "stock" => 14,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['name' => $product['name']], $product);
        }
    }
}
