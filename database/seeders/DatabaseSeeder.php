<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 0. Admin User
        User::updateOrCreate(
            ['email' => 'admin@zeenparfum.com'],
            [
                'name' => 'Admin ZEEN Atelier',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 1. Categories
        $catExtrait = Category::updateOrCreate(['slug' => 'extrait-de-parfum'], [
            'name' => 'Extrait de Parfum',
            'subtitle' => '30-40% Pure Perfume Oil — Konsentrasi Tertinggi',
            'image' => 'https://images.unsplash.com/photo-1588405748880-12d1d2a59f75?auto=format&fit=crop&w=800&q=80',
            'description' => 'Konsentrasi minyak wangi murni tertinggi untuk daya tahan 14–20 jam.',
            'order_position' => 1,
            'is_active' => true,
        ]);

        $catEdp = Category::updateOrCreate(['slug' => 'eau-de-parfum'], [
            'name' => 'Eau de Parfum',
            'subtitle' => '20–22% Concentration — Everyday Luxury',
            'image' => 'https://images.unsplash.com/photo-1547887537-6158d64c35b3?auto=format&fit=crop&w=800&q=80',
            'description' => 'Konsentrasi sempurna untuk aroma elegan dan tahan lama sepanjang hari.',
            'order_position' => 2,
            'is_active' => true,
        ]);

        $catLocal = Category::updateOrCreate(['slug' => 'local-luxury'], [
            'name' => 'Local Luxury',
            'subtitle' => 'Parfum Lokal Premium — Bangga Buatan Indonesia',
            'image' => 'https://images.unsplash.com/photo-1616949755610-8c9bbc08f138?auto=format&fit=crop&w=800&q=80',
            'description' => 'Koleksi parfum premium dari brand-brand lokal Indonesia terbaik.',
            'order_position' => 3,
            'is_active' => true,
        ]);

        $catDiscovery = Category::updateOrCreate(['slug' => 'discovery-sets'], [
            'name' => 'Discovery Sets',
            'subtitle' => 'Coba Sebelum Memilih — 5ml Travel Size',
            'image' => 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?auto=format&fit=crop&w=800&q=80',
            'description' => 'Eksplorasi koleksi parfum pilihan dalam format travel size eksklusif.',
            'order_position' => 4,
            'is_active' => true,
        ]);

        // =====================================================
        // 2. PRODUK — BRAND LOKAL INDONESIA PREMIUM
        // =====================================================

        // --- SCENTPLUS (Brand lokal premium no. 1 Indonesia) ---
        $p1 = Product::updateOrCreate(['slug' => 'scentplus-noir-oud'], [
            'category_id' => $catExtrait->id,
            'name' => 'SCENTPLUS — NOIR OUD',
            'subtitle' => 'Oud Langka, Amber Hitam & Vanilla Madagascar',
            'concentration' => 'Extrait de Parfum (35%)',
            'fragrance_family' => 'Woody & Oud',
            'price' => 489000,
            'original_price' => 599000,
            'rating' => 4.95,
            'reviews_count' => 2841,
            'badge' => 'BESTSELLER',
            'size_default' => '50ml',
            'available_sizes' => ['30ml', '50ml', '100ml'],
            'top_notes' => 'Saffron, Black Pepper, Calabrian Bergamot',
            'heart_notes' => 'Cambodian Oud, Damask Rose, Turkish Incense',
            'base_notes' => 'Madagascar Vanilla, Dark Amber, Smoky Vetiver',
            'longevity' => '14–18 Jam',
            'sillage' => 'Kuat & Magnetis',
            'description' => 'Scentplus Noir Oud adalah mahakarya parfum lokal Indonesia yang mendunia. Memadukan oud langka Kamboja, mawar Damask, dan vanilla hitam Madagascar dalam komposisi yang gelap, misterius, dan tak terlupakan. Tahan lebih dari 14 jam di kulit.',
            'image' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=1000&q=85',
            'gallery' => [
                'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?auto=format&fit=crop&w=1000&q=85',
                'https://images.unsplash.com/photo-1547887537-6158d64c35b3?auto=format&fit=crop&w=1000&q=85',
            ],
            'stock' => 85,
            'is_featured' => true,
            'is_bestseller' => true,
            'is_new' => false,
            'is_active' => true,
        ]);

        // --- SCENTPLUS ROSE GOLD ---
        $p2 = Product::updateOrCreate(['slug' => 'scentplus-rose-gold'], [
            'category_id' => $catEdp->id,
            'name' => 'SCENTPLUS — ROSE GOLD',
            'subtitle' => 'Mawar Turki, Lychee & Musk Sutra Putih',
            'concentration' => 'Eau de Parfum (20%)',
            'fragrance_family' => 'Floral & Gourmand',
            'price' => 329000,
            'original_price' => 399000,
            'rating' => 4.90,
            'reviews_count' => 1923,
            'badge' => 'TERFAVORIT',
            'size_default' => '50ml',
            'available_sizes' => ['30ml', '50ml'],
            'top_notes' => 'Lychee, Peach Blossom, Pink Pepper',
            'heart_notes' => 'Turkish Rose Absolute, Gardenia, Muguet',
            'base_notes' => 'Silky White Musk, Sandalwood, Blonde Amber',
            'longevity' => '10–12 Jam',
            'sillage' => 'Lembut & Memukau',
            'description' => 'Scentplus Rose Gold — feminin, elegan, dan menawan. Aroma mawar Turki yang mewah dipadukan lychee segar dan musk sutra putih menciptakan jejak aroma yang membuat siapa pun berbalik dan bertanya.',
            'image' => 'https://images.unsplash.com/photo-1588405748880-12d1d2a59f75?auto=format&fit=crop&w=1000&q=85',
            'gallery' => [
                'https://images.unsplash.com/photo-1588405748880-12d1d2a59f75?auto=format&fit=crop&w=1000&q=85',
            ],
            'stock' => 120,
            'is_featured' => true,
            'is_bestseller' => true,
            'is_new' => false,
            'is_active' => true,
        ]);

        // --- ERHA PARFUM (Brand dermatology & parfum premium) ---
        $p3 = Product::updateOrCreate(['slug' => 'erha-parfum-savage-noir'], [
            'category_id' => $catExtrait->id,
            'name' => 'ERHA PARFUM — SAVAGE NOIR',
            'subtitle' => 'Bergamot Kalimantan, Kayu Gaharu & Blue Amber',
            'concentration' => 'Extrait de Parfum (30%)',
            'fragrance_family' => 'Woody & Fresh',
            'price' => 545000,
            'original_price' => 650000,
            'rating' => 4.88,
            'reviews_count' => 1156,
            'badge' => 'PREMIUM LOCAL',
            'size_default' => '50ml',
            'available_sizes' => ['50ml', '100ml'],
            'top_notes' => 'Bergamot Kalimantan, Sea Salt, Pink Pepper',
            'heart_notes' => 'Indonesian Agarwood, Violet, Cardamom',
            'base_notes' => 'Blue Amber, Cashmeran, White Musk',
            'longevity' => '12–16 Jam',
            'sillage' => 'Sopan & Berkarakter',
            'description' => 'Erha Parfum Savage Noir menggabungkan kekayaan bahan baku lokal Indonesia — bergamot Kalimantan dan gaharu pilihan — dengan sentuhan blue amber modern yang sophisticated. Cocok untuk pria maupun wanita yang menghargai keunikan aroma.',
            'image' => 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?auto=format&fit=crop&w=1000&q=85',
            'gallery' => [
                'https://images.unsplash.com/photo-1523293182086-7651a899d37f?auto=format&fit=crop&w=1000&q=85',
            ],
            'stock' => 60,
            'is_featured' => true,
            'is_bestseller' => false,
            'is_new' => true,
            'is_active' => true,
        ]);

        // --- MINERAL BOTANICA (Brand lokal premium skincare & parfum) ---
        $p4 = Product::updateOrCreate(['slug' => 'mineral-botanica-fleur-de-patchouli'], [
            'category_id' => $catLocal->id,
            'name' => 'MINERAL BOTANICA — FLEUR DE PATCHOULI',
            'subtitle' => 'Patchouli Sumatera, Jasmine Indonesia & Neroli',
            'concentration' => 'Eau de Parfum (22%)',
            'fragrance_family' => 'Floral & Earthy',
            'price' => 299000,
            'original_price' => 365000,
            'rating' => 4.85,
            'reviews_count' => 876,
            'badge' => 'NATURAL',
            'size_default' => '50ml',
            'available_sizes' => ['50ml', '100ml'],
            'top_notes' => 'Italian Neroli, Green Tea, Indonesian Jasmine',
            'heart_notes' => 'Patchouli Sumatera, Ylang-Ylang, Rose Water',
            'base_notes' => 'Cedarwood, Sandalwood, Soft Musk',
            'longevity' => '8–12 Jam',
            'sillage' => 'Natural & Earthy',
            'description' => 'Mineral Botanica Fleur de Patchouli merayakan kekayaan alam Indonesia. Patchouli Sumatera berkualitas premium dan melati lokal Indonesia dipadukan secara harmonis menghasilkan aroma yang membumi, hangat, dan penuh karakter alami.',
            'image' => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?auto=format&fit=crop&w=1000&q=85',
            'gallery' => [
                'https://images.unsplash.com/photo-1594035910387-fea47794261f?auto=format&fit=crop&w=1000&q=85',
            ],
            'stock' => 95,
            'is_featured' => true,
            'is_bestseller' => false,
            'is_new' => false,
            'is_active' => true,
        ]);

        // --- MORPH ATELIER (Brand niche lokal artisan) ---
        $p5 = Product::updateOrCreate(['slug' => 'morph-atelier-accord-bali'], [
            'category_id' => $catLocal->id,
            'name' => 'MORPH ATELIER — ACCORD BALI',
            'subtitle' => 'Frangipani Bali, Coconut Milk & Warm Sandalwood',
            'concentration' => 'Eau de Parfum (20%)',
            'fragrance_family' => 'Floral & Tropical',
            'price' => 425000,
            'original_price' => 499000,
            'rating' => 4.92,
            'reviews_count' => 643,
            'badge' => 'ARTISAN LOCAL',
            'size_default' => '50ml',
            'available_sizes' => ['30ml', '50ml'],
            'top_notes' => 'Bali Frangipani, Coconut Water, Passionfruit',
            'heart_notes' => 'Tiare Flower, Gardenia, Tropical Ylang',
            'base_notes' => 'Balinese Sandalwood, Coconut Milk, Vanilla Orchid',
            'longevity' => '10–14 Jam',
            'sillage' => 'Tropis & Hangat',
            'description' => 'Morph Atelier Accord Bali adalah perwujudan surga tropis Indonesia dalam sebotol parfum. Frangipani Bali yang ikonik, air kelapa segar, dan sandalwood Bali menciptakan pengalaman sensorik layaknya matahari terbenam di pantai Seminyak.',
            'image' => 'https://images.unsplash.com/photo-1616949755610-8c9bbc08f138?auto=format&fit=crop&w=1000&q=85',
            'gallery' => [
                'https://images.unsplash.com/photo-1616949755610-8c9bbc08f138?auto=format&fit=crop&w=1000&q=85',
            ],
            'stock' => 42,
            'is_featured' => true,
            'is_bestseller' => true,
            'is_new' => false,
            'is_active' => true,
        ]);

        // --- YOUSTAR (Brand lokal modern & affordable luxury) ---
        $p6 = Product::updateOrCreate(['slug' => 'youstar-midnight-musk'], [
            'category_id' => $catEdp->id,
            'name' => 'YOUSTAR — MIDNIGHT MUSK',
            'subtitle' => 'Musk Kasmir, Vanilla Bean & Smoky Woods',
            'concentration' => 'Eau de Parfum (18%)',
            'fragrance_family' => 'Warm & Musky',
            'price' => 199000,
            'original_price' => 249000,
            'rating' => 4.80,
            'reviews_count' => 3421,
            'badge' => 'VIRAL',
            'size_default' => '50ml',
            'available_sizes' => ['50ml'],
            'top_notes' => 'Pear, Bergamot, White Magnolia',
            'heart_notes' => 'Cashmere Musk, Peony, Soft Iris',
            'base_notes' => 'Tahitian Vanilla, Smoke Wood, Amber Crystals',
            'longevity' => '8–10 Jam',
            'sillage' => 'Cozy & Intimate',
            'description' => 'Youstar Midnight Musk adalah sensasi viral yang telah dipakai lebih dari 50.000 pelanggan di Indonesia. Musky, hangat, dan addictive — cocok untuk malam romantis maupun casual day-out.',
            'image' => 'https://images.unsplash.com/photo-1547887537-6158d64c35b3?auto=format&fit=crop&w=1000&q=85',
            'gallery' => [
                'https://images.unsplash.com/photo-1547887537-6158d64c35b3?auto=format&fit=crop&w=1000&q=85',
            ],
            'stock' => 200,
            'is_featured' => false,
            'is_bestseller' => true,
            'is_new' => false,
            'is_active' => true,
        ]);

        // --- LAFINE (Brand lokal artisan niche parfum Indonesia) ---
        $p7 = Product::updateOrCreate(['slug' => 'lafine-raja-ampat'], [
            'category_id' => $catLocal->id,
            'name' => 'LAFINE — RAJA AMPAT',
            'subtitle' => 'Oceanic Sea Breeze, White Coral & Papuan Driftwood',
            'concentration' => 'Extrait de Parfum (30%)',
            'fragrance_family' => 'Fresh & Aquatic',
            'price' => 575000,
            'original_price' => 695000,
            'rating' => 4.94,
            'reviews_count' => 512,
            'badge' => 'LIMITED ED.',
            'size_default' => '50ml',
            'available_sizes' => ['30ml', '50ml'],
            'top_notes' => 'Sea Salt, Ozone, Calabrian Bergamot',
            'heart_notes' => 'White Coral Accord, Coconut Water, Water Jasmine',
            'base_notes' => 'Papuan Driftwood, Cashmeran, Blonde Musk',
            'longevity' => '12–16 Jam',
            'sillage' => 'Segar & Bebas',
            'description' => 'LAFINE Raja Ampat adalah ode kepada keindahan laut Indonesia yang tak tertandingi. Hembusan angin laut segar Papua, koral putih bersih, dan kayu apung menghadirkan petualangan sensorik yang membebaskan jiwa.',
            'image' => 'https://images.unsplash.com/photo-1612103198005-b238a9e7e626?auto=format&fit=crop&w=1000&q=85',
            'gallery' => [
                'https://images.unsplash.com/photo-1612103198005-b238a9e7e626?auto=format&fit=crop&w=1000&q=85',
            ],
            'stock' => 30,
            'is_featured' => true,
            'is_bestseller' => false,
            'is_new' => true,
            'is_active' => true,
        ]);

        // --- ZEEN SIGNATURE DISCOVERY BOX ---
        $p8 = Product::updateOrCreate(['slug' => 'zeen-discovery-box-local-edition'], [
            'category_id' => $catDiscovery->id,
            'name' => 'ZEEN DISCOVERY BOX — LOCAL EDITION',
            'subtitle' => '5 Brand Lokal Terbaik × 5ml Travel Vial dalam Gift Box Premium',
            'concentration' => 'Multi Concentration',
            'fragrance_family' => 'Discovery Set',
            'price' => 345000,
            'original_price' => 429000,
            'rating' => 4.98,
            'reviews_count' => 1876,
            'badge' => 'WAJIB COBA',
            'size_default' => '5 × 5ml',
            'available_sizes' => ['5 × 5ml'],
            'top_notes' => 'Isi: Scentplus Noir Oud, Rose Gold, Erha Savage Noir, Morph Accord Bali, Lafine Raja Ampat',
            'heart_notes' => 'Setiap vial dilengkapi atomizer presisi khas luxury travel size dengan label nama brand asli',
            'base_notes' => 'Termasuk Voucher Diskon Rp 75.000 untuk pembelian Full Bottle berikutnya',
            'longevity' => 'Beragam (8–18 Jam)',
            'sillage' => 'Diverse Olfactory Journey',
            'description' => 'Set Discovery terbaik untuk mengenal deretan parfum lokal premium Indonesia pilihan ZEEN Atelier. Dikemas dalam gift box premium berbalut linen hitam elegan — hadiah sempurna untuk diri sendiri maupun orang tersayang.',
            'image' => 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?auto=format&fit=crop&w=1000&q=85',
            'gallery' => [
                'https://images.unsplash.com/photo-1523293182086-7651a899d37f?auto=format&fit=crop&w=1000&q=85',
            ],
            'stock' => 150,
            'is_featured' => true,
            'is_bestseller' => true,
            'is_new' => false,
            'is_active' => true,
        ]);

        // =====================================================
        // 3. REVIEWS
        // =====================================================
        $reviews = [
            [$p1->id, 'Reza Aulia', 'Jakarta Selatan', 5, 'Scentplus Noir Oud ini beneran kelas dunia! Daya tahannya 16 jam di kulit saya. Beli botol kedua udah dari bulan lalu. Bangga banget parfum lokal bisa sekelas ini.'],
            [$p1->id, 'Nadia Salsabila', 'Surabaya', 5, 'Baunya sophisticated banget. Opening oud-nya dramatis tapi dry down vanilla-nya bikin nagih. Dari kantor ke dinner masih on point.'],
            [$p2->id, 'Tiara Putri', 'Bandung', 5, 'Rose Gold ini temen setia saya ke kantor. Mawarnya ga norak, ga berat, tapi tetap luxury feel banget. Banyak yang nanya pake parfum apa!'],
            [$p2->id, 'Dina Marwati', 'Yogyakarta', 5, 'Cocok banget buat daily wear. Harga segini dapet parfum sequalitas ini, luar biasa brand Indonesia.'],
            [$p3->id, 'Farhan Hadi', 'Medan', 5, 'Erha Savage Noir ini pilihan blind buy terbaik saya! Bergamot-nya segar, terus tengahnya oud yang sophisticated. Perfect buat ngantor dan meeting.'],
            [$p4->id, 'Sari Dewi', 'Bali', 5, 'Mineral Botanica Fleur de Patchouli ini beneran smells like Bali. Patchouli-nya ga berat sama sekali, earthy tapi tetap floral. Love it!'],
            [$p5->id, 'Kevin Santoso', 'Jakarta Pusat', 5, 'Accord Bali ini literally tropical paradise in a bottle. Pakai ini berasa lagi liburan di Seminyak. Morph Atelier emang juara buat konsep aroma lokal.'],
            [$p6->id, 'Aulia Rahman', 'Makassar', 4, 'Youstar Midnight Musk sesuai ekspektasi — cozy, warm, addictive. Harganya juga sangat terjangkau buat hasil yang sekeren ini.'],
            [$p7->id, 'Bima Wicaksono', 'Manado', 5, 'LAFINE Raja Ampat ini extraordinary! Baunya beneran kayak di pinggir laut Raja Ampat. Daya tahannya juga amazing. Very proud of Indonesian brand!'],
            [$p8->id, 'Chelsea Gunawan', 'Jakarta Barat', 5, 'Discovery Box Local Edition ini worth every rupiah! Jadi tau mana yang paling cocok sebelum beli full bottle. Semua 5 brand-nya top banget.'],
        ];

        foreach ($reviews as [$pid, $name, $city, $rating, $comment]) {
            Review::create([
                'product_id' => $pid,
                'customer_name' => $name,
                'customer_city' => $city,
                'rating' => $rating,
                'comment' => $comment,
                'is_verified_buyer' => true,
            ]);
        }
    }
}
