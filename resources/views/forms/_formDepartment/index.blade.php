<!-- Título do Departamento -->
<div class="mb-3">
    <div class="form-floating">
        <input type="text" name="title" class="form-control" id="title" placeholder="" value="{{ old('title', $data->title ?? '') }}">
        <label for="title">Adicionar novo Departamento</label>
    </div>
</div>

<!-- Descrição do Departamento -->
<div class="mb-3">
    <div class="form-floating">
        <textarea name="description" class="form-control" id="description" placeholder="" style="height: 100px;">{{ old('description', $data->description ?? '') }}</textarea>
        <label for="description">Descrição do Departamento</label>
    </div>
</div>

<!-- Botão de envio -->
<div class="d-grid gap-2 col-6 mx-auto mt-4">
   @if(isset($data))
       <button type="submit" class="btn btn-outline-secondary btn-lg">
           <i class="fas fa-check-circle me-2"></i>Atualizar Departamento
       </button>
   @else
       <button type="submit" class="btn btn-outline-secondary btn-lg">
           <i class="fas fa-check-circle me-2"></i>Criar Departamento
       </button>
   @endif
</div>
