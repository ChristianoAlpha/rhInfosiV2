<div class="mb-3">
    <div class="form-floating">
        <input type="text" name="name" class="form-control" id="name" placeholder=""
            value="{{ old('name', $course->name ?? '') }}">
        <label for="name">Adicionar novo Curso</label>
    </div>
</div>

<div class="mb-3">
    <div class="form-floating">
        <textarea name="description" class="form-control" id="description" style="height: 100px;">{{ old('description', $course->description ?? '') }}</textarea>
        <label for="description">Descrição</label>
    </div>
</div>

<div class="d-grid gap-2 col-6 mx-auto mt-4">
    @if (isset($course))
        <button type="submit" class="btn btn-outline-secondary btn-lg">
            <i class="fas fa-save me-2"></i>Atualizar Curso
        </button>
    @else
        <button type="submit" class="btn btn-outline-secondary btn-lg">
        <i class="fas fa-save me-2"></i>Adicionar Curso
    </button>
    @endif
</div>
