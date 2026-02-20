<div class="mb-3">
    <div class="form-floating">
        <input type="text" name="name" class="form-control" id="name" placeholder=""
            value="{{ old('name', $data->name ?? '') }}" required>
        <label for="name">Adicionar novo vínculo</label>
    </div>
</div>

<div class="mb-3">
    <div class="form-floating">
        <textarea name="description" class="form-control" id="description" style="height: 100px;">{{ old('description', $data->description ?? '') }}</textarea>
        <label for="description">Descrição (opcional)</label>
    </div>
</div>

<div class="d-grid gap-2 col-6 mx-auto mt-4">
    <button type="submit" class="btn btn-outline-secondary btn-lg">
        <i class="fas fa-check-circle me-2"></i>Salvar
    </button>
</div>
