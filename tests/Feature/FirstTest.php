<?php

namespace Tests\Feature;

use App\Events\NewOrderEvent;
use App\Rule;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FirstTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        dump("testExample");
        $this->assertTrue(true);
    }

    public function testApi()
    {
        dump("testApi");

        $this->json("POST", "learn/api1")
            ->assertStatus(200)
            ->assertJsonFragment(
                [
                    "name" => "Apple X",
                    "price" => 300
                ]
            );


        $this->assertTrue(true);
    }

    public function testHttp()
    {
        $response = $this->call('POST', 'learn/f1')
            ->assertStatus(200);

        //dump($response);
        dump($response->getContent());
    }

    public function testDatabase()
    {
        // Сделать вызов в приложение...

        $this->assertDatabaseHas('products', ['base_price' => 300]);
    }

    public function testDatabase2()
    {
        // Предотвращение срабатывания событий
        //$this->expectsEvents(App\Events\UserRegistered::class);

        //$this->expectsJobs(App\Jobs\PurchasePodcast::class);

        //$this->session(['foo' => 'bar']);
        //$this->seed('DatabaseSeeder');
        //$this->be($user);

        Rule::create([
            "name" => "admin",
            "description" => "Site Administrator"
        ]);

        $this->assertDatabaseHas('rules', ['name' => 'admin']);
    }

    public function testF2()
    {
        $this->expectsEvents([NewOrderEvent::class]);
        $this->be(User::find(1));

        $response = $this->call('POST', 'learn/f2')
            ->assertStatus(200);

        dump($response->getContent());
    }

    //
    private function trash()
    {
        $this->withoutMiddleware();

        //$this->visit('/')
        //->withSession(['foo' => 'bar'])
        //->see('Laravel 5')
        //->click('')
        //->type("Slava', "name")
        //->press("Sign In")
        //->seePageis('about-us')

        $user = User::find(1);
        $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->visit('/')
            ->see('Hello, '.$user->name);
        //->assertResponseStatus($code);


        $response = $this->call('POST', '/user', ['name' => 'Taylor']);
        $response = $this->action('GET', 'UserController@profile', ['user' => 1]);

        //test API
        $this->json('POST', '/user', ['name' => 'Sally'])
            ->assertJson([
                'created' => true,
                'name'
            ]);
            //seeJsonEquals()

        $user = factory(App\User::class)->create([
            'name' => 'Abigail',
        ]);
    }

}
