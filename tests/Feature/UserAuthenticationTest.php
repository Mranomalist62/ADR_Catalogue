<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test halaman login dapat diakses.
     */
    public function test_login_page_can_be_accessed(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Test halaman register dapat diakses.
     */
    public function test_register_page_can_be_accessed(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /**
     * Test user dapat register dengan data yang valid.
     */
    public function test_user_can_register_with_valid_data(): void
    {
        $userData = [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'nomor_handphone' => '08123456789',
        ];

        $response = $this->post('/register', $userData);

        // Verifikasi redirect ke home
        $response->assertRedirect('/');

        // Verifikasi user dibuat di database
        $this->assertDatabaseHas('user', [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        // Verifikasi user profile dibuat
        $user = User::where('email', 'john@example.com')->first();
        $this->assertDatabaseHas('user_profile', [
            'id' => $user->id_profile,
            'nomor_handphone' => '08123456789',
        ]);

        // Verifikasi user terautentikasi
        $this->assertAuthenticatedAs($user, 'user');
    }

    /**
     * Test user tidak dapat register dengan email yang sudah ada.
     */
    public function test_user_cannot_register_with_existing_email(): void
    {
        // Buat user terlebih dahulu
        $existingUser = User::factory()->create([
            'email' => 'existing@example.com',
        ]);

        $userData = [
            'nama' => 'New User',
            'email' => 'existing@example.com', // Email yang sudah ada
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'nomor_handphone' => '08123456789',
        ];

        $response = $this->post('/register', $userData);

        // Verifikasi ada error validasi
        $response->assertSessionHasErrors('email');

        // Verifikasi user baru tidak dibuat
        $this->assertEquals(1, User::where('email', 'existing@example.com')->count());
    }

    /**
     * Test user tidak dapat register dengan password yang tidak cocok.
     */
    public function test_user_cannot_register_with_mismatched_passwords(): void
    {
        $userData = [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'differentpassword', // Password tidak cocok
            'nomor_handphone' => '08123456789',
        ];

        $response = $this->post('/register', $userData);

        // Verifikasi ada error validasi
        $response->assertSessionHasErrors('password');

        // Verifikasi user tidak dibuat
        $this->assertDatabaseMissing('user', [
            'email' => 'john@example.com',
        ]);
    }

    /**
     * Test user dapat login dengan nomor handphone dan password yang benar.
     */
    public function test_user_can_login_with_correct_credentials(): void
    {
        // Buat user profile
        $profile = UserProfile::create([
            'nomor_handphone' => '08123456789',
            'path_thumbnail' => null,
        ]);

        // Buat user
        $user = User::create([
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'id_profile' => $profile->id,
        ]);

        $loginData = [
            'nomor_handphone' => '08123456789',
            'password' => 'password123',
        ];

        $response = $this->post('/login', $loginData);

        // Verifikasi redirect ke home
        $response->assertRedirect('/');

        // Verifikasi user terautentikasi
        $this->assertAuthenticatedAs($user, 'user');
    }

    /**
     * Test user tidak dapat login dengan nomor handphone yang salah.
     */
    public function test_user_cannot_login_with_wrong_phone_number(): void
    {
        // Buat user profile
        $profile = UserProfile::create([
            'nomor_handphone' => '08123456789',
            'path_thumbnail' => null,
        ]);

        // Buat user
        User::create([
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'id_profile' => $profile->id,
        ]);

        $loginData = [
            'nomor_handphone' => '08987654321', // Nomor handphone salah
            'password' => 'password123',
        ];

        $response = $this->post('/login', $loginData);

        // Verifikasi redirect kembali ke login dengan error
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('nomor_handphone');

        // Verifikasi user tidak terautentikasi
        $this->assertGuest('user');
    }

    /**
     * Test user tidak dapat login dengan password yang salah.
     */
    public function test_user_cannot_login_with_wrong_password(): void
    {
        // Buat user profile
        $profile = UserProfile::create([
            'nomor_handphone' => '08123456789',
            'path_thumbnail' => null,
        ]);

        // Buat user
        User::create([
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'id_profile' => $profile->id,
        ]);

        $loginData = [
            'nomor_handphone' => '08123456789',
            'password' => 'wrongpassword', // Password salah
        ];

        $response = $this->post('/login', $loginData);

        // Verifikasi redirect kembali ke login dengan error
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('nomor_handphone');

        // Verifikasi user tidak terautentikasi
        $this->assertGuest('user');
    }

    /**
     * Test user dapat logout.
     */
    public function test_user_can_logout(): void
    {
        // Buat user profile
        $profile = UserProfile::create([
            'nomor_handphone' => '08123456789',
            'path_thumbnail' => null,
        ]);

        // Buat user
        $user = User::create([
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'id_profile' => $profile->id,
        ]);

        // Login user
        $this->actingAs($user, 'user');

        // Verifikasi user terautentikasi
        $this->assertAuthenticatedAs($user, 'user');

        // Logout
        $response = $this->post('/logout');

        // Verifikasi response JSON
        $response->assertJson([
            'message' => 'User logged out successfully',
        ]);

        // Verifikasi user tidak terautentikasi
        $this->assertGuest('user');
    }

    /**
     * Test user dapat mengakses profile setelah login.
     */
    public function test_user_can_access_profile_after_login(): void
    {
        // Buat user profile
        $profile = UserProfile::create([
            'nomor_handphone' => '08123456789',
            'path_thumbnail' => null,
        ]);

        // Buat user
        $user = User::create([
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'id_profile' => $profile->id,
        ]);

        // Login user
        $this->actingAs($user, 'user');

        // Akses profile
        $response = $this->get('/profile');

        // Verifikasi response JSON
        $response->assertJsonStructure([
            'user' => [
                'id',
                'nama',
                'email',
                'id_profile',
                'created_at',
                'updated_at'
            ]
        ]);

        $response->assertJson([
            'user' => [
                'nama' => 'John Doe',
                'email' => 'john@example.com',
                'id_profile' => $profile->id,
            ]
        ]);
    }

    /**
     * Test user tidak dapat mengakses profile tanpa login.
     */
    public function test_user_cannot_access_profile_without_login(): void
    {
        $response = $this->get('/profile');

        // Verifikasi redirect ke login
        $response->assertRedirect('/login');
    }

    /**
     * Test register tanpa nomor handphone.
     */
    public function test_user_can_register_without_phone_number(): void
    {
        $userData = [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'nomor_handphone' => null, // Nomor handphone opsional
        ];

        $response = $this->post('/register', $userData);

        // Verifikasi redirect ke home
        $response->assertRedirect('/');

        // Verifikasi user dibuat di database
        $this->assertDatabaseHas('user', [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        // Verifikasi user terautentikasi
        $user = User::where('email', 'john@example.com')->first();
        $this->assertAuthenticatedAs($user, 'user');
    }
}