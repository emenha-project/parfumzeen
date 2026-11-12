<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Categories
        $catExtrait = Category::create([
            'name' => 'Extrait de Parfum',
            'slug' => 'extrait-de-parfum',
            'subtitle' => '35% Pure Perfume Oil - Highest Concentration',
            'image' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=800&q=80',
            'description' => 'Konsentrasi minyak wangi murni tertinggi untuk daya tahan 16+ jam dengan sillage mewah.',
            'order_position' => 1,
        ]);

        $catEdp = Category::create([
            'name' => 'Eau de Parfum',
            'slug' => 'eau-de-parfum',
            'subtitle' => '20% Concentration - Everyday Elegance',
            'image' => 'https://images.unsplash.com/photo-1547887537-6158d64c35b3?auto=format&fit=crop&w=800&q=80',
            'description' => 'Aroma elegan dan versatile untuk menemani impresi berkelas sepanjang hari.',
            'order_position' => 2,
        ]);

        $catDiscovery = Category::create([
            'name' => 'Discovery Sets',
            'slug' => 'discovery-sets',
            'subtitle' => 'Explore 5 Signature Scents in 5ml Vials',
            'image' => 'https://images.unsplash.com/photo-1616949755610-8c9bbc08f138?auto=format&fit=crop&w=800&q=80',
            'description' => 'Eksplorasi seluruh koleksi mahakarya ZEEN sebelum menentukan aroma tanda tangan Anda.',
            'order_position' => 3,
        ]);

        $catUnisex = Category::create([
            'name' => 'Unisex Collection',
            'slug' => 'unisex',
            'subtitle' => 'Gender-Fluid Modern Haute Parfumerie',
            'image' => 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?auto=format&fit=crop&w=800&q=80',
            'description' => 'Kreasi tanpa batas gender, didesain untuk kepribadian yang autentik dan percaya diri.',
            'order_position' => 4,
        ]);

        // 2. Products
        $p1 = Product::create([
            'category_id' => $catExtrait->id,
            'name' => 'NOIR ABSOLU',
            'slug' => 'noir-absolu',
            'subtitle' => 'Smoked Oud & Warm Bourbon Vanilla',
            'concentration' => 'Extrait de Parfum (35%)',
            'fragrance_family' => 'Woody & Amber',
            'price' => 785000,
            'original_price' => 950000,
            'rating' => 4.95,
            'reviews_count' => 184,
            'badge' => 'BESTSELLER',
            'size_default' => '50ml',
            'available_sizes' => ['50ml', '100ml'],
            'top_notes' => 'Pink Pepper, Cardamom, Calabrian Bergamot',
            'heart_notes' => 'Rare Cambodian Oud, Orris Butter, Spiced Incense',
            'base_notes' => 'Madagascar Bourbon Vanilla, Ambergris, Haitian Vetiver',
            'longevity' => '16+ Jam (Very Long Lasting)',
            'sillage' => 'Enchanting & Heavy',
            'description' => 'Misterius, megah, dan tak terlupakan. Noir Absolu memadukan kemewahan kayu oud langka dengan kehangatan vanilla bourbon hitam pilihan.',
            'image' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=1000&q=85',
            'gallery' => [
                'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=1000&q=85',
                'https://images.unsplash.com/photo-1523293182086-7651a899d37f?auto=format&fit=crop&w=1000&q=85',
                'https://images.unsplash.com/photo-1547887537-6158d64c35b3?auto=format&fit=crop&w=1000&q=85',
            ],
            'stock' => 45,
            'is_featured' => true,
            'is_bestseller' => true,
            'is_new' => false,
        ]);

        $p2 = Product::create([
            'category_id' => $catExtrait->id,
            'name' => 'SANTAL IMPÉRIAL',
            'slug' => 'santal-imperial',
            'subtitle' => 'Creamy Australian Sandalwood & Violet Leaf',
            'concentration' => 'Extrait de Parfum (35%)',
            'fragrance_family' => 'Woody & Creamy',
            'price' => 745000,
            'original_price' => 890000,
            'rating' => 4.90,
            'reviews_count' => 142,
            'badge' => 'EXCLUSIVE',
            'size_default' => '50ml',
            'available_sizes' => ['50ml', '100ml'],
            'top_notes' => 'Australian Sandalwood, Cardamom, Papyrus',
            'heart_notes' => 'Violet Leaves, Tuscan Iris, Cedarwood',
            'base_notes' => 'Clean White Amber, Leather Accord, Cashmere Musk',
            'longevity' => '14 - 18 Jam',
            'sillage' => 'Moderate to Strong',
            'description' => 'Kemurnian sandalwood paling halus berpadu daun violet dan sentuhan kulit bangsawan. Aroma yang memancarkan aura ketenangan dan kelas dunia.',
            'image' => 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?auto=format&fit=crop&w=1000&q=85',
            'gallery' => [
                'https://images.unsplash.com/photo-1523293182086-7651a899d37f?auto=format&fit=crop&w=1000&q=85',
                'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=1000&q=85',
            ],
            'stock' => 38,
            'is_featured' => true,
            'is_bestseller' => true,
            'is_new' => false,
        ]);

        $p3 = Product::create([
            'category_id' => $catEdp->id,
            'name' => 'FLEUR BLANCHE',
            'slug' => 'fleur-blanche',
            'subtitle' => 'Sunlit Grasse Jasmine & Silky Neroli',
            'concentration' => 'Eau de Parfum (22%)',
            'fragrance_family' => 'Floral & Solar',
            'price' => 585000,
            'original_price' => 690000,
            'rating' => 4.88,
            'reviews_count' => 96,
            'badge' => 'NEW',
            'size_default' => '50ml',
            'available_sizes' => ['50ml', '100ml'],
            'top_notes' => 'Italian Neroli, Mandarine, Pear Blossom',
            'heart_notes' => 'Grasse Jasmine Sambac, Tuberose, Orange Flower',
            'base_notes' => 'Silky White Musk, Golden Cedar, Solar Amber',
            'longevity' => '10 - 12 Jam',
            'sillage' => 'Radiant & Airy',
            'description' => 'Buket bunga putih bermandikan sinar mentari Prancis selatan. Lembut, feminin, bercahaya, dan memikat sejak semprotan pertama.',
            'image' => 'https://images.unsplash.com/photo-1588405748880-12d1d2a59f75?auto=format&fit=crop&w=1000&q=85',
            'gallery' => [
                'https://images.unsplash.com/photo-1588405748880-12d1d2a59f75?auto=format&fit=crop&w=1000&q=85',
            ],
            'stock' => 50,
            'is_featured' => true,
            'is_bestseller' => false,
            'is_new' => true,
        ]);

        $p4 = Product::create([
            'category_id' => $catExtrait->id,
            'name' => 'OUD SOLEIL',
            'slug' => 'oud-soleil',
            'subtitle' => 'Golden Saffron, Turkish Rose & Dark Amber',
            'concentration' => 'Extrait de Parfum (35%)',
            'fragrance_family' => 'Amber & Oriental',
            'price' => 820000,
            'original_price' => 990000,
            'rating' => 4.96,
            'reviews_count' => 210,
            'badge' => 'BESTSELLER',
            'size_default' => '50ml',
            'available_sizes' => ['50ml', '100ml'],
            'top_notes' => 'Persian Saffron, Raspberry, Thyme',
            'heart_notes' => 'Turkish Rose Absolute, Jasmine, Frankincense',
            'base_notes' => 'Rich Ambergris, Leather, Agarwood Oud',
            'longevity' => '16+ Jam',
            'sillage' => 'Powerful & Magnetic',
            'description' => 'Perpaduan megah rempah saffron emas dan mawar beludru Turki di atas dasar ambergris intens.',
            'image' => 'https://images.unsplash.com/photo-1547887537-6158d64c35b3?auto=format&fit=crop&w=1000&q=85',
            'gallery' => [
                'https://images.unsplash.com/photo-1547887537-6158d64c35b3?auto=format&fit=crop&w=1000&q=85',
            ],
            'stock' => 25,
            'is_featured' => true,
            'is_bestseller' => true,
            'is_new' => false,
        ]);

        $p5 = Product::create([
            'category_id' => $catUnisex->id,
            'name' => 'CÔTE D\'AZUR',
            'slug' => 'cote-d-azur',
            'subtitle' => 'Crisp Sea Salt, Calabrian Bergamot & Driftwood',
            'concentration' => 'Eau de Parfum (20%)',
            'fragrance_family' => 'Fresh & Aquatic',
            'price' => 560000,
            'original_price' => 650000,
            'rating' => 4.85,
            'reviews_count' => 77,
            'badge' => 'FRESH',
            'size_default' => '50ml',
            'available_sizes' => ['50ml', '100ml'],
            'top_notes' => 'Calabrian Bergamot, Sea Salt Accord, Grapefruit',
            'heart_notes' => 'Sage, Rosemary, Mineral Marine Notes',
            'base_notes' => 'Sun-bleached Driftwood, Ambrette Seed, Vetiver',
            'longevity' => '8 - 10 Jam',
            'sillage' => 'Crisp & Clean',
            'description' => 'Hembusan angin pesisir Mediterania yang segar dan membangkitkan gairah hidup. Sangat cocok untuk iklim tropis Indonesia.',
            'image' => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?auto=format&fit=crop&w=1000&q=85',
            'gallery' => [
                'https://images.unsplash.com/photo-1594035910387-fea47794261f?auto=format&fit=crop&w=1000&q=85',
            ],
            'stock' => 60,
            'is_featured' => true,
            'is_bestseller' => false,
            'is_new' => false,
        ]);

        $p6 = Product::create([
            'category_id' => $catDiscovery->id,
            'name' => 'THE SIGNATURE DISCOVERY BOX',
            'slug' => 'the-signature-discovery-box',
            'subtitle' => 'Curated 5 x 5ml Travel Vials in Black Velvet Gift Case',
            'concentration' => 'Multi Concentration (Extrait & EDP)',
            'fragrance_family' => 'Discovery Set',
            'price' => 385000,
            'original_price' => 450000,
            'rating' => 4.98,
            'reviews_count' => 312,
            'badge' => 'MUST HAVE',
            'size_default' => '5 x 5ml',
            'available_sizes' => ['5 x 5ml'],
            'top_notes' => 'Includes: Noir Absolu, Santal Impérial, Fleur Blanche, Oud Soleil & Côte d\'Azur',
            'heart_notes' => 'Setiap vial dilengkapi atomizer presisi khas luxury travel size',
            'base_notes' => 'Termasuk Voucher Diskon Rp 100.000 untuk pembelian Full Bottle berikutnya',
            'longevity' => '12 - 16 Jam',
            'sillage' => 'Diverse Olfactory Experience',
            'description' => 'Hadiah sempurna untuk diri sendiri atau orang tersayang. Jelajahi lima maha karya aroma ZEEN dalam kemasan mewah berbalut beludru hitam.',
            'image' => 'https://images.unsplash.com/photo-1616949755610-8c9bbc08f138?auto=format&fit=crop&w=1000&q=85',
            'gallery' => [
                'https://images.unsplash.com/photo-1616949755610-8c9bbc08f138?auto=format&fit=crop&w=1000&q=85',
            ],
            'stock' => 100,
            'is_featured' => true,
            'is_bestseller' => true,
            'is_new' => false,
        ]);

        // 3. Reviews
        Review::create([
            'product_id' => $p1->id,
            'customer_name' => 'Clarissa W.',
            'customer_city' => 'Jakarta Selatan',
            'rating' => 5,
            'comment' => 'Wanginya gila mewah banget! Dipake dari jam 8 pagi meeting sampe malam masih kecium dry down vanillanya yang smoky. Packagingnya super high-end mirip brand niche Eropa.',
            'is_verified_buyer' => true,
        ]);

        Review::create([
            'product_id' => $p1->id,
            'customer_name' => 'Rangga Pratama',
            'customer_city' => 'Surabaya',
            'rating' => 5,
            'comment' => 'Blind buy terbaik tahun ini. Sillage-nya sopan tapi berkarakter kuat, orang-orang di kantor auto nanya pake parfum apa.',
            'is_verified_buyer' => true,
        ]);

        Review::create([
            'product_id' => $p2->id,
            'customer_name' => 'Dian Sastrowardoyo',
            'customer_city' => 'Bandung',
            'rating' => 5,
            'comment' => 'Sandalwood-nya creamy banget, calming tapi tetap punya wibawa. Ga nusuk sama sekali di hidung.',
            'is_verified_buyer' => true,
        ]);

        Review::create([
            'product_id' => $p6->id,
            'customer_name' => 'Bima Arya',
            'customer_city' => 'Jakarta Pusat',
            'rating' => 5,
            'comment' => 'Wajib banget beli discovery set ini sebelum beli botol gedenya. Semua aromanya juara, ga ada yang gagal.',
            'is_verified_buyer' => true,
        ]);
    }
}
