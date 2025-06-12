<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Producto;
 
class CategoriaProductoSeeder extends Seeder
{
    public function run(): void
    {
        // Crear categorías usando firstOrCreate
        $categorias = [
            ['nombre' => 'Electrónica', 'slug' => 'electronica'],
            ['nombre' => 'Ropa', 'slug' => 'ropa'],
            ['nombre' => 'Hogar', 'slug' => 'hogar'],
        ];
 
        foreach ($categorias as $catData) {
            Categoria::firstOrCreate(
                ['slug' => $catData['slug']],
                $catData
            );
        }
 
        // Crear productos
        $productos = [
            [
                'titulo' => 'Laptop X1',
                'descripcion' => 'Laptop de alto rendimiento',
                'precio' => 1200.50,
                'image' => 'https://firebasestorage.googleapis.com/v0/b/tienda-online-dev-8fa41.firebasestorage.app/o/Jerry%2Flaptop.jpg?alt=media&token=400daa8f-6ab8-4ab8-b55d-057e10f1e1c5',
                'stock' => 10,
            ],
            [
                'titulo' => 'Camisa Casual',
                'descripcion' => 'Camisa de algodón',
                'precio' => 25.99,
                'image' => 'https://firebasestorage.googleapis.com/v0/b/tienda-online-dev-8fa41.firebasestorage.app/o/Jerry%2Fcamisa_casual.jpg?alt=media&token=0084a4ac-f4ae-43fd-89f4-acdc61f66e82',
                'stock' => 50,
            ],
            [
                'titulo' => 'Sofá Moderno',
                'descripcion' => 'Sofá de diseño cómodo',
                'precio' => 499.99,
                'image' => 'https://firebasestorage.googleapis.com/v0/b/tienda-online-dev-8fa41.firebasestorage.app/o/Jerry%2Fsofa.png?alt=media&token=0084a4ac-f4ae-43fd-89f4-acdc61f66e82',
                'stock' => 5,
            ],
        ];
 
        foreach ($productos as $prodData) {
            $producto = Producto::firstOrCreate(
                ['titulo' => $prodData['titulo']],
                $prodData
            );
 
            // Asignar categorías aleatorias
            $categoriaIds = Categoria::inRandomOrder()->limit(rand(1, 2))->pluck('id')->toArray();
            $producto->categorias()->sync($categoriaIds);
        }
    }
}
