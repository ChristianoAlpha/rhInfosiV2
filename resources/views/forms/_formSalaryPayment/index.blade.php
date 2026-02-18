<!-- BUSCA DE FUNCIONÁRIO -->
<div class="mb-4">
    <label class="form-label">Funcionário <span class="text-danger">*</span></label>
    <div class="position-relative">
        <input type="text" id="employeeSearch" class="form-control" placeholder="Digite o nome do funcionário..."
            autocomplete="off">
        <div id="employeeList" class="list-group position-absolute w-100 mt-1 shadow"
            style="z-index: 1000; max-height: 300px; overflow-y: auto; display: none;">
        </div>
    </div>
    <input type="hidden" name="employeeId" id="employeeId" required>
    @error('employeeId')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<!-- DADOS DO FUNCIONÁRIO -->
<div id="employeeInfo" class="row mb-4 p-3 border rounded bg-light d-none">
    <div class="col-md-6"><strong>Nome:</strong> <span id="empName">-</span></div>
    <div class="col-md-6"><strong>Departamento:</strong> <span id="empDept">-</span></div>
    <div class="col-md-6"><strong>E-mail:</strong> <span id="empEmail">-</span></div>
    <div class="col-md-6"><strong>IBAN:</strong> <span id="empIban">-</span></div>
</div>

<!-- Mês -->
<div class="row">
    <div class="col-md-4">
        <label class="form-label">Mês de Competência <span class="text-danger">*</span></label>
        <select name="workMonth" id="workMonth" class="form-select" required>
            @for ($i = 0; $i <= 11; $i++)
                @php $m = now()->subMonths($i) @endphp
                <option value="{{ $m->format('m') }}" {{ $m->isCurrentMonth() ? 'selected' : '' }}>
                    {{ $m->translatedFormat('F') }}
                </option>
            @endfor
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Ano de Competência <span class="text-danger">*</span></label>
        <select name="workYear" id="workYear" class="form-select" required>
            @for ($i = 0; $i <= 11; $i++)
                @php $m = now()->subMonths($i) @endphp
                <option value="{{ $m->format('Y') }}" {{ $m->isCurrentMonth() ? 'selected' : '' }}>
                    {{ $m->translatedFormat('Y') }}
                </option>
            @endfor
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="paymentStatus" class="form-select" required>
            <option value="Pending">Pendente</option>
            <option value="Completed" selected>Concluído</option>
            <option value="Failed">Falhou</option>
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Salário Básico (Kz) <span class="text-danger">*</span></label>
        <input type="text" name="baseSalary" id="baseSalary" class="form-control currency" value="0,00" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Subsídios (Kz) <span class="text-danger">*</span></label>
        <input type="text" name="subsidies" id="subsidies" class="form-control currency" value="0,00" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">IRT (%) <span class="text-danger">*</span></label>
        <input type="text" name="irtRate" id="irtRate" class="form-control currency" value="0,00" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">INSS (%) <span class="text-danger">*</span></label>
        <input type="text" name="inssRate" id="inssRate" class="form-control currency" value="0,00" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Desconto por Faltas (Kz)</label>
        <input type="text" name="discount" id="discount" class="form-control currency" value="0,00">
        <small id="absentInfo" class="form-text text-muted"></small>
    </div>
    <div class="col-md-4">
        <label class="form-label">Data de Pagamento</label>
        <input type="date" name="paymentDate" class="form-control" value="{{ now()->format('Y-m-d') }}">
    </div>
</div>

<div class="mt-3">
    <label class="form-label">Comentário</label>
    <textarea name="paymentComment" class="form-control" rows="3"></textarea>
</div>

<div class="d-flex justify-content-center mt-4">
    <button type="submit" class="btn btn-outline-secondary btn-lg px-5">
        Salvar Pagamento
    </button>
</div>
