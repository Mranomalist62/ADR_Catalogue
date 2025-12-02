<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test apakah model User dapat dibuat dengan data yang valid.
     */
    public function test_user_can_be_created_with_valid_data(): void
    {
        // Buat user profile terlebih dahulu
        $profile = UserProfile::create([
            'nomor_handphone' => '08123456789',
            'path_thumbnail' => null,
        ]);

        // Buat user dengan data valid
        $user = User::create([
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
            'id_profile' => $profile->id,
        ]);

        // Verifikasi user berhasil dibuat
        $this->assertDatabaseHas('user', [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'id_profile' => $profile->id,
        ]);

        // Verifikasi password di-hash
        $this->assertNotEquals('password123', $user->password);
    }

    /**
     * Test relasi user dengan profile.
     */
    public function test_user_belongs_to_profile(): void
    {
        $profile = UserProfile::create([
            'nomor_handphone' => '08123456789',
            'path_thumbnail' => null,
        ]);

        $user = User::create([
            'nama' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => bcrypt('password123'),
            'id_profile' => $profile->id,
        ]);

        // Test relasi
        $this->assertInstanceOf(UserProfile::class, $user->profile);
        $this->assertEquals($profile->id, $user->profile->id);
    }

    /**
     * Test relasi user dengan addresses (one to many).
     */
    public function test_user_has_many_addresses(): void
    {
        $profile = UserProfile::create([
            'nomor_handphone' => '08123456789',
            'path_thumbnail' => null,
        ]);

        $user = User::create([
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
            'id_profile' => $profile->id,
        ]);

        // Buat addresses untuk user
        $address1 = Address::create([
            'id_user' => $user->id,
            'nama' => 'Alamat Utama',
            'desk_alamat' => 'Jl. Test 123, Jakarta, DKI Jakarta, 12345',
            'selected' => true,
        ]);

        $address2 = Address::create([
            'id_user' => $user->id,
            'nama' => 'Alamat Kedua',
            'desk_alamat' => 'Jl. Test 456, Bandung, Jawa Barat, 40123',
            'selected' => false,
        ]);

        // Test relasi
        $this->assertCount(2, $user->addresses);
        $this->assertInstanceOf(Address::class, $user->addresses->first());
    }

    /**
     * Test relasi user dengan orders (one to many).
     */
    public function test_user_has_many_orders(): void
    {
        $profile = UserProfile::create([
            'nomor_handphone' => '08123456789',
            'path_thumbnail' => null,
        ]);

        $user = User::create([
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
            'id_profile' => $profile->id,
        ]);

        // Test relasi orders (akan dibuat di test Order)
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->orders);
    }

    /**
     * Test fillable attributes pada model User.
     */
    public function test_user_fillable_attributes(): void
    {
        $profile = UserProfile::create([
            'nomor_handphone' => '08123456789',
            'path_thumbnail' => null,
        ]);

        $user = new User([
            'nama' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'id_profile' => $profile->id,
        ]);

        $this->assertEquals('Test User', $user->nama);
        $this->assertEquals('test@example.com', $user->email);
        $this->assertEquals($profile->id, $user->id_profile);
    }

    /**
     * Test hidden attributes pada model User.
     */
    public function test_user_hidden_attributes(): void
    {
        $profile = UserProfile::create([
            'nomor_handphone' => '08123456789',
            'path_thumbnail' => null,
        ]);

        $user = User::create([
            'nama' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'id_profile' => $profile->id,
        ]);

        $userArray = $user->toArray();
        
        // Password dan remember_token harus tidak ada di array
        $this->assertArrayNotHasKey('password', $userArray);
        $this->assertArrayNotHasKey('remember_token', $userArray);
    }
}