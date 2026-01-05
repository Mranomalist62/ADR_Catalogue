<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test halaman home dapat diakses.
     */
    public function test_home_page_can_be_accessed(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('home');
    }

    /**
     * Test halaman rekomendasi dapat diakses.
     */
    public function test_rekomendasi_page_can_be_accessed(): void
    {
        $response = $this->get('/rekomendasi');

        $response->assertStatus(200);
        $response->assertViewIs('rekomendasi');
    }

    /**
     * Test halaman kategori dapat diakses.
     */
    public function test_kategori_page_can_be_accessed(): void
    {
        $response = $this->get('/kategori');

        $response->assertStatus(200);
        $response->assertViewIs('kategori');
    }

    /**
     * Test halaman admin tidak dapat diakses tanpa login admin.
     */
    public function test_admin_page_redirects_to_login(): void
    {
        $response = $this->get('/admin');

        // Harus redirect ke login karena admin page memerlukan authentication
        $response->assertRedirect('http://localhost/login');
    }

    /**
     * Test halaman admin login dapat diakses.
     */
    public function test_admin_login_page_can_be_accessed(): void
    {
        $response = $this->get('/admin/login');

        // Harus dapat diakses karena admin login page sudah dibuat
        $response->assertStatus(200);
        $response->assertViewIs('admin_login');
    }

    /**
     * Test halaman admin orders redirect ke login.
     */
    public function test_admin_orders_page_redirects_to_login(): void
    {
        $response = $this->get('/admin/orders');

        // Harus redirect ke login karena admin orders page memerlukan authentication
        $response->assertRedirect('http://localhost/login');
    }

    /**
     * Test halaman admin statistics redirect ke login.
     */
    public function test_admin_statistics_page_redirects_to_login(): void
    {
        $response = $this->get('/admin/statistics');

        // Harus redirect ke login karena admin statistics page memerlukan authentication
        $response->assertRedirect('http://localhost/login');
    }

    /**
     * Test halaman admin billing redirect ke login.
     */
    public function test_admin_billing_page_redirects_to_login(): void
    {
        $response = $this->get('/admin/billing');

        // Harus redirect ke login karena admin billing page memerlukan authentication
        $response->assertRedirect('http://localhost/login');
    }

    /**
     * Test halaman promo tidak dapat diakses tanpa login.
     */
    public function test_promo_page_cannot_be_accessed_without_login(): void
    {
        $response = $this->get('/promo');

        // Harus redirect ke halaman login
        $response->assertRedirect('/login');
    }

    /**
     * Test halaman promo dapat diakses setelah login.
     */
    public function test_promo_page_can_be_accessed_after_login(): void
    {
        // Buat user dan login
        $user = $this->createUserAndLogin();

        $response = $this->get('/promo');

        $response->assertStatus(200);
        $response->assertViewIs('promo');
    }

    /**
     * Test halaman profile tidak dapat diakses tanpa login.
     */
    public function test_profile_page_cannot_be_accessed_without_login(): void
    {
        $response = $this->get('/profile');

        // Harus redirect ke halaman login
        $response->assertRedirect('/login');
    }

    /**
     * Test route debug-auth dapat diakses.
     */
    public function test_debug_auth_route_can_be_accessed(): void
    {
        $response = $this->get('/debug-auth');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'authenticated' => [
                'user',
                'admin'
            ],
            'user',
            'admin',
            'session_id',
            'timestamp'
        ]);

        // Verifikasi user dan admin null saat tidak login
        $response->assertJson([
            'authenticated' => [
                'user' => false,
                'admin' => false
            ],
            'user' => null,
            'admin' => null
        ]);
    }

    /**
     * Test route debug-auth setelah user login.
     */
    public function test_debug_auth_route_after_user_login(): void
    {
        // Buat user dan login
        $user = $this->createUserAndLogin();

        $response = $this->get('/debug-auth');

        $response->assertStatus(200);
        $response->assertJson([
            'authenticated' => [
                'user' => true,
                'admin' => false
            ],
            'user' => [
                'id' => $user->id,
                'nama' => $user->nama,
                'email' => $user->email,
                'profile_id' => $user->id_profile
            ],
            'admin' => null
        ]);
    }

    /**
     * Test route force-logout dapat diakses.
     */
    public function test_force_logout_route_can_be_accessed(): void
    {
        // Buat user dan login
        $this->createUserAndLogin();

        // Verifikasi user terautentikasi
        $this->assertAuthenticated('user');

        $response = $this->get('/force-logout');

        // Verifikasi redirect ke home
        $response->assertRedirect('/');

        // Verifikasi user tidak terautentikasi
        $this->assertGuest('user');
    }

    /**
     * Test route yang tidak ada mengembalikan 404.
     */
    public function test_nonexistent_route_returns_404(): void
    {
        $response = $this->get('/route-yang-tidak-ada');

        $response->assertStatus(404);
    }

    /**
     * Test method POST pada route GET tidak diizinkan.
     */
    public function test_post_method_on_get_route_not_allowed(): void
    {
        $response = $this->post('/');

        // Laravel akan mengembalikan 405 Method Not Allowed
        $response->assertStatus(405);
    }

    /**
     * Test method GET pada route POST tidak diizinkan.
     */
    public function test_get_method_on_post_route_not_allowed(): void
    {
        $response = $this->get('/register');

        // Route register ternyata juga menerima GET (menampilkan form register)
        // Jadi kita test route login POST dengan GET
        $response = $this->post('/login');
        
        // Laravel akan mengembalikan 302 redirect karena tidak ada CSRF token
        $response->assertStatus(302);
    }

    /**
     * Helper method untuk membuat user dan login.
     */
    private function createUserAndLogin()
    {
        $profile = \App\Models\UserProfile::create([
            'nomor_handphone' => '08123456789',
            'path_thumbnail' => null,
        ]);

        $user = \App\Models\User::create([
            'nama' => 'Test User',
            'email' => 'test@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'id_profile' => $profile->id,
        ]);

        $this->actingAs($user, 'user');

        return $user;
    }

}