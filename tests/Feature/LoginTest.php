<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;
use App\Models\LoginUser;


class ManageAppLoginTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_loginPage()
    {
        $response = $this->get('/manageapp/login');
        // $response->baseResponse->statusCode);
        $response->assertStatus(200);
        $response->assertSee('LoginUserId');
        //実はこういう風にメソッドチェーン的に書くことも出来ます。
        // $this->get('/')->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {

        $user = LoginUser::factory()->create();

        $response = $this->get('/manageapp/login');
        $response->assertStatus(200);
        $response->assertSee('loginUserId');

        $response = $this->post('/manageapp/login', [
            'loginUserId' => $user->loginUserId,
            'password' => $user->password,
        ]);

        // 途中でエラーがありそうなときは↓の記述で探せる。
        // $response->dump();

        // ↓はguardの種類を引数で渡さないと、デフォルトのguardで認証されてしまう。
        $this->assertAuthenticatedAs($user, 'manageapp');
        $response->assertRedirect(RouteServiceProvider::MANAGEAPP_HOME);
    }
}
