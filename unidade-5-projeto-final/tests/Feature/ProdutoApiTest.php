<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProdutoApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_pode_criar_um_produto_com_sucesso(): void
    {
        $categoria = Categoria::create(['nome' => 'Eletrônicos']);

        $payload = [
            'nome' => 'Smartphone X',
            'descricao' => 'Celular de última geração',
            'preco' => 2500.00,
            'categoria_id' => $categoria->id
        ];

        $response = $this->postJson('/api/produtos', $payload);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data' => ['id', 'nome', 'descricao', 'preco', 'categoria', 'created_at', 'updated_at']
                 ]);

        $this->assertDatabaseHas('produtos', ['nome' => 'Smartphone X']);
    }
}