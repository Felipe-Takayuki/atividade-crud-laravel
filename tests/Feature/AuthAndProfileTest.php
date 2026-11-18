<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthAndProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login_from_protected_routes(): void
    {
        $this->get('/profile')->assertRedirect(route('login'));
        $this->get('/profile/edit')->assertRedirect(route('login'));
        $this->get('/tasks')->assertRedirect(route('login'));
    }

    public function test_user_can_register_and_is_authenticated(): void
    {
        $response = $this->post('/register', [
            'name' => 'Maria Silva',
            'email' => 'maria@example.com',
            'password' => 'segredo123',
            'password_confirmation' => 'segredo123',
        ]);

        $response->assertRedirect(route('profile.show'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'name' => 'Maria Silva',
            'email' => 'maria@example.com',
        ]);
    }

    public function test_user_can_login_and_logout(): void
    {
        $user = User::factory()->create([
            'password' => 'minhasenha',
        ]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'senha-errada',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'minhasenha',
        ])->assertRedirect(route('profile.show'));

        $this->assertAuthenticatedAs($user);

        $this->post('/logout')->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_authenticated_user_can_view_and_update_profile(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/profile')
            ->assertOk()
            ->assertSee($user->name)
            ->assertSee($user->email);

        $this->actingAs($user)
            ->patch('/profile', [
                'name' => 'Nome Atualizado',
                'email' => 'novo@example.com',
            ])
            ->assertRedirect(route('profile.show'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Nome Atualizado',
            'email' => 'novo@example.com',
        ]);
    }

    public function test_authenticated_user_can_update_password(): void
    {
        $user = User::factory()->create([
            'password' => 'senhaantiga123',
        ]);

        $this->actingAs($user)
            ->put('/profile/password', [
                'current_password' => 'errada123',
                'password' => 'novasenha123',
                'password_confirmation' => 'novasenha123',
            ])
            ->assertSessionHasErrors('current_password');

        $this->actingAs($user)
            ->put('/profile/password', [
                'current_password' => 'senhaantiga123',
                'password' => 'novasenha123',
                'password_confirmation' => 'novasenha123',
            ])
            ->assertRedirect(route('profile.edit'))
            ->assertSessionHas('success');

        $user->refresh();
        $this->assertTrue(Hash::check('novasenha123', $user->password));
    }

    public function test_authenticated_user_can_delete_account_with_cascade_on_tasks(): void
    {
        $user = User::factory()->create([
            'password' => 'confirmar123',
        ]);

        $task = Task::create([
            'user_id' => $user->id,
            'title' => 'Tarefa de teste',
            'status' => 'pending',
            'priority' => 'medium',
        ]);

        // Senha incorreta não exclui a conta
        $this->actingAs($user)
            ->delete('/profile', ['password' => 'errada'])
            ->assertSessionHasErrorsIn('userDeletion', 'password');

        $this->assertDatabaseHas('users', ['id' => $user->id]);

        // Senha correta exclui usuário e tarefas em cascata
        $this->actingAs($user)
            ->delete('/profile', ['password' => 'confirmar123'])
            ->assertRedirect(route('login'))
            ->assertSessionHas('success');

        $this->assertGuest();
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_authenticated_user_can_view_tasks_index_page(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/tasks')
            ->assertOk()
            ->assertSee('Minhas tarefas');
    }
}
