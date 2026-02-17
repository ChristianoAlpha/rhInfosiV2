<div class="mb-3">
    <div class="form-floating">
        <input type="text" name="name" id="name" class="form-control" placeholder="" value="{{ old('name') }}"
            required>
        <label for="name">Nome do Tipo</label>
    </div>
</div>

<div class="mb-3">
    <div class="form-floating">
        <textarea name="description" id="description" class="form-control" placeholder="" style="height: 100px;">{{ old('description') }}</textarea>
        <label for="description">Descrição (opcional)</label>
    </div>
</div>

<div class="d-grid gap-2 col-4 mx-auto mt-4">
    <button class="btn btn-outline-secondary">
    <i class="fas fa-save me-1"></i> Salvar
    </button>
</div>
