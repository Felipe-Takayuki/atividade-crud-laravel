<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    public const STATUSES = [
        'pending'     => ['label' => 'Pendente',     'class' => 'bg-zinc-100 text-zinc-700 border-zinc-200'],
        'in_progress' => ['label' => 'Em andamento', 'class' => 'bg-amber-50 text-amber-700 border-amber-200'],
        'completed'   => ['label' => 'Concluída',    'class' => 'bg-emerald-50 text-emerald-700 border-emerald-200'],
    ];

    public const PRIORITIES = [
        'low'    => ['label' => 'Baixa', 'class' => 'bg-zinc-100 text-zinc-600 border-zinc-200'],
        'medium' => ['label' => 'Média', 'class' => 'bg-blue-50 text-blue-700 border-blue-200'],
        'high'   => ['label' => 'Alta',  'class' => 'bg-red-50 text-red-700 border-red-200'],
    ];

    /**
     * Atributos que podem ser preenchidos em massa (mass assignment).
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
    ];

    /**
     * Conversão automática de tipos dos atributos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }

    /**
     * Usuário proprietário desta tarefa.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retorna o rótulo e as classes CSS do badge de status da tarefa.
     *
     * @return array{label: string, class: string}
     */
    public function statusBadge(): array
    {
        return self::STATUSES[$this->status] ?? [
            'label' => ucfirst($this->status),
            'class' => 'bg-zinc-100 text-zinc-700 border-zinc-200',
        ];
    }

    /**
     * Retorna o rótulo e as classes CSS do badge de prioridade da tarefa.
     *
     * @return array{label: string, class: string}
     */
    public function priorityBadge(): array
    {
        return self::PRIORITIES[$this->priority] ?? [
            'label' => ucfirst($this->priority),
            'class' => 'bg-zinc-100 text-zinc-600 border-zinc-200',
        ];
    }
}
