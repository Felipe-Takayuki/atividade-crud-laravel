@php
    $task = $task ?? null;
@endphp

<div>
    <label for="title" class="block text-sm font-medium text-zinc-700 mb-1">
        Título <span class="text-red-500">*</span>
    </label>
    <input id="title"
           type="text"
           name="title"
           value="{{ old('title', $task?->title) }}"
           required
           placeholder="Ex: Finalizar documentação da API"
           class="w-full rounded-md border @error('title') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-zinc-300 focus:border-zinc-900 focus:ring-zinc-900 @enderror px-3 py-2 text-sm text-zinc-900 focus:outline-none focus:ring-1 transition">
    @error('title')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="description" class="block text-sm font-medium text-zinc-700 mb-1">
        Descrição
    </label>
    <textarea id="description"
              name="description"
              rows="4"
              placeholder="Detalhes ou anotações sobre a tarefa..."
              class="w-full rounded-md border @error('description') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-zinc-300 focus:border-zinc-900 focus:ring-zinc-900 @enderror px-3 py-2 text-sm text-zinc-900 focus:outline-none focus:ring-1 transition">{{ old('description', $task?->description) }}</textarea>
    @error('description')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <div>
        <label for="status" class="block text-sm font-medium text-zinc-700 mb-1">
            Status <span class="text-red-500">*</span>
        </label>
        <select id="status"
                name="status"
                required
                class="w-full rounded-md border @error('status') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-zinc-300 focus:border-zinc-900 focus:ring-zinc-900 @enderror px-3 py-2 text-sm text-zinc-900 bg-white focus:outline-none focus:ring-1 transition">
            @foreach (App\Models\Task::STATUSES as $value => $status)
                <option value="{{ $value }}" @selected(old('status', $task?->status ?? 'pending') === $value)>
                    {{ $status['label'] }}
                </option>
            @endforeach
        </select>
        @error('status')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="priority" class="block text-sm font-medium text-zinc-700 mb-1">
            Prioridade <span class="text-red-500">*</span>
        </label>
        <select id="priority"
                name="priority"
                required
                class="w-full rounded-md border @error('priority') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-zinc-300 focus:border-zinc-900 focus:ring-zinc-900 @enderror px-3 py-2 text-sm text-zinc-900 bg-white focus:outline-none focus:ring-1 transition">
            @foreach (App\Models\Task::PRIORITIES as $value => $priority)
                <option value="{{ $value }}" @selected(old('priority', $task?->priority ?? 'medium') === $value)>
                    {{ $priority['label'] }}
                </option>
            @endforeach
        </select>
        @error('priority')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="due_date" class="block text-sm font-medium text-zinc-700 mb-1">
            Prazo
        </label>
        <input id="due_date"
               type="date"
               name="due_date"
               value="{{ old('due_date', $task?->due_date?->format('Y-m-d')) }}"
               class="w-full rounded-md border @error('due_date') border-red-400 focus:border-red-500 focus:ring-red-500 @else border-zinc-300 focus:border-zinc-900 focus:ring-zinc-900 @enderror px-3 py-2 text-sm text-zinc-900 focus:outline-none focus:ring-1 transition">
        @error('due_date')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-100">
    <a href="{{ route('tasks.index') }}"
       class="px-4 py-2 rounded-md border border-zinc-300 bg-white hover:bg-zinc-50 text-zinc-700 text-sm font-medium transition">
        Cancelar
    </a>
    <button type="submit"
            class="px-4 py-2 rounded-md bg-zinc-900 hover:bg-zinc-800 text-white text-sm font-medium transition cursor-pointer">
        {{ $submitLabel }}
    </button>
</div>
