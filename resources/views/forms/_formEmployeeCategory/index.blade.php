<div class="mb-3">
    <div class="form-floating">
        <input type="text" name="name" class="form-control" id="name" placeholder=""
            value="{{ old('name', $employeeCategory->name ?? '') }}">
        <label for="name">Adicionar nova categoria</label>
    </div>
</div>

<div class="mb-3">
    <div class="form-floating">
        <textarea name="description" class="form-control" id="description" style="height: 100px;">{{ old('description', $employeeCategory->description ?? '') }}</textarea>
        <label for="description">Descrição</label>
    </div>
</div>

<div class="d-grid gap-2 col-6 mx-auto mt-4">
    @if(isset($employeeCategory))
        <button type="submit" class="btn btn-outline-secondary">Atualizar Categoria</button>
    @else
        <button type="submit" class="btn btn-outline-secondary">Adicionar Categoria</button>
    @endif
</div>
