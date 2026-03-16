<?php

namespace Database\Seeders;

use App\Models\TukangProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Central point: Telkom University Bandung.
     */
    private const CENTER_LAT = -6.9730;
    private const CENTER_LNG = 107.6307;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ─── 1. Admin ───────────────────────────────────────────
        User::create([
            'name'         => 'Admin KANGMAS',
            'email'        => 'admin@kangmas.com',
            'password'     => Hash::make('password'),
            'role'         => 'admin',
            'phone_number' => '081200000000',
        ]);

        // ─── 2. Regular Users (Pencari Jasa) ────────────────────
        $users = [
            ['name' => 'Budi Santoso',   'email' => 'user1@kangmas.com', 'phone_number' => '081200000001'],
            ['name' => 'Siti Nurhaliza', 'email' => 'user2@kangmas.com', 'phone_number' => '081200000002'],
            ['name' => 'Andi Prasetyo', 'email' => 'user3@kangmas.com', 'phone_number' => '081200000003'],
        ];

        foreach ($users as $u) {
            User::create([
                'name'         => $u['name'],
                'email'        => $u['email'],
                'password'     => Hash::make('password'),
                'role'         => 'user',
                'phone_number' => $u['phone_number'],
            ]);
        }

        // ─── 3. Tukangs ────────────────────────────────────────
        $tukangData = [
            ['name' => 'Pak Udin Listrik',    'category' => 'listrik',  'base_price' => 150000],
            ['name' => 'Mas Joko Electrical',  'category' => 'listrik',  'base_price' => 200000],
            ['name' => 'Pak Soleh Listrik',    'category' => 'listrik',  'base_price' => 100000],
            ['name' => 'Pak Agus Plumbing',    'category' => 'air',      'base_price' => 120000],
            ['name' => 'Mas Dedi Pipa',        'category' => 'air',      'base_price' => 175000],
            ['name' => 'Pak Hasan Air',        'category' => 'air',      'base_price' => 80000],
            ['name' => 'Pak Rudi Bangunan',    'category' => 'bangunan', 'base_price' => 250000],
            ['name' => 'Mas Eko Konstruksi',   'category' => 'bangunan', 'base_price' => 300000],
            ['name' => 'Pak Wahyu Builder',    'category' => 'bangunan', 'base_price' => 200000],
            ['name' => 'Mas Fajar Bangunan',   'category' => 'bangunan', 'base_price' => 180000],
        ];

        foreach ($tukangData as $index => $t) {
            // Create the user account for this tukang
            $tukangUser = User::create([
                'name'         => $t['name'],
                'email'        => 'tukang' . ($index + 1) . '@kangmas.com',
                'password'     => Hash::make('password'),
                'role'         => 'tukang',
                'phone_number' => '08120000' . str_pad($index + 10, 4, '0', STR_PAD_LEFT),
            ]);

            // Generate random coordinates within ~20 km of Telkom University
            [$lat, $lng] = $this->randomCoordinateWithinRadius(
                self::CENTER_LAT,
                self::CENTER_LNG,
                20 // max km
            );

            // Random rating between 3.0 and 5.0
            $avgRating = round(mt_rand(300, 500) / 100, 2);
            $totalReviews = mt_rand(5, 50);

            TukangProfile::create([
                'user_id'       => $tukangUser->id,
                'category'      => $t['category'],
                'latitude'      => $lat,
                'longitude'     => $lng,
                'address'       => 'Jl. Contoh No. ' . ($index + 1) . ', Bandung',
                'is_active'     => true,
                'avg_rating'    => $avgRating,
                'total_reviews' => $totalReviews,
                'base_price'    => $t['base_price'],
            ]);
        }

        $this->command->info('✅ Seeded: 1 Admin, 3 Users, 10 Tukangs with profiles.');
    }

    /**
     * Generate a random coordinate within a given radius (km) of a center point.
     *
     * @return array{0: float, 1: float} [latitude, longitude]
     */
    private function randomCoordinateWithinRadius(float $lat, float $lng, float $radiusKm): array
    {
        // 1 degree latitude ≈ 111.32 km
        $latOffset = $radiusKm / 111.32;
        // 1 degree longitude varies with latitude
        $lngOffset = $radiusKm / (111.32 * cos(deg2rad($lat)));

        $newLat = $lat + (mt_rand(-10000, 10000) / 10000) * $latOffset;
        $newLng = $lng + (mt_rand(-10000, 10000) / 10000) * $lngOffset;

        return [round($newLat, 7), round($newLng, 7)];
    }
}
