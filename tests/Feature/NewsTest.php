<?php
namespace Tests\Feature;

use App\News;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /** @test */
    public function the_posts_show_route_can_be_accessed()
    {
        // Arrange
        // Dodajmy do bazy danych wpis
        $post = News::create([
            'nazwa' => 'Testowa aktualność z phpunit',
            'slug' => 'testowa-aktualnosc-z-phpunit',
            'status' => 1,
            'meta_tytul' => '',
            'meta_tytul' => '',
            'data' => '2020-01-07',
            'wprowadzenie' => 'To jest wprowadzenie',
            'tekst' => 'To jest tekst',
        ]);

        // Act
        // Wykonajmy zapytanie pod adres wpisu
        $response = $this->get('/aktualnosci/' . $post->slug);

        // Assert
        // Sprawdźmy że w odpowiedzi znajduje się tytuł wpisu
        $response->assertStatus(200)
            ->assertSeeText('Testowa aktualność z phpunit');
    }
}
