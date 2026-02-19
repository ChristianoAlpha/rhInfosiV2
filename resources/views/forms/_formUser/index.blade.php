 <div class="row g-3 mb-4">
     <div class="col-md-6">
         <div class="form-floating">
             <select name="employeeId" id="employeeId" class="form-select">
                 <option value="">Nenhum funcionário vinculado</option>
                 @foreach ($employees as $item)
                     {{-- <option value="{{ $employee->id }}"
                            data-email="{{ $employee->email }}"
                            data-fullname="{{ $employee->fullName }}"
                            data-photo="{{ $employee->photo ? asset('frontend/images/departments/'.$employee->photo) : asset('frontend/images/default.png') }}"
                            {{ $user->employeeId == $employee->id ? 'selected' : '' }}>
                      {{ $employee->fullName }}
                    </option> --}}
                     <option value="{{ $item->id }}">
                         {{ $item->id . ' - ' . $item->fullName }}
                     </option>
                 @endforeach
             </select>
             <label for="employeeId">Vincular funcionário</label>
         </div>
     </div>
     <div class="col-md-6">
         <div class="form-floating">
             <input type="text" id="name" class="form-control" value="{{ $user->name }}">
             <label>Nome do Funcionário</label>
         </div>
     </div>
 </div>

 <div class="text-center mb-4" id="employeePhotoContainer" style="display: none;">
     <img id="employeePhoto" src="" alt="Foto atual" class="rounded-circle shadow"
         style="width: 150px; height: 150px; object-fit: cover;">
     <p class="text-muted mt-2"><small>Foto atual do funcionário vinculado</small></p>
 </div>

 <div class="row g-3 mb-4">
     <div class="col-md-6">
         <div class="form-floating">
             <select name="role" id="role" class="form-select" required>
                 <option value="">Selecione o Papel</option>
                 <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrador</option>
                 <option value="departmentHead" {{ $user->role == 'departmentHead' ? 'selected' : '' }}>Chefe de
                     Departamento</option>
                 <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Funcionário</option>
             </select>
             <label for="role">Papel *</label>
         </div>
     </div>
     <div class="col-md-6">
         <div class="form-floating">
             <input type="email" name="email" id="email" class="form-control" placeholder=" "
                 value="{{ old('email', $user->email) }}" required>
             <label for="email">Email *</label>
         </div>
     </div>
 </div>

 <!-- Campos Diretor -->
 <div id="director_fields" style="display: {{ $user->role === 'director' ? 'block' : 'none' }};" class="mb-4">
     <h5 class="text-primary mb-3"><i class="fas fa-crown me-2"></i>Diretor</h5>
     <div class="row g-3">
         <div class="col-md-6">
             <div class="form-floating">
                 <textarea name="biography" class="form-control" style="height: 120px;" placeholder=" ">{{ old('biography', $user->biography) }}</textarea>
                 <label>Biografia</label>
             </div>
         </div>
         <div class="col-md-6">
             <div class="form-floating">
                 <input type="url" name="linkedin" class="form-control" placeholder=" "
                     value="{{ old('linkedin', $user->linkedin) }}">
                 <label>LinkedIn</label>
             </div>
         </div>
     </div>
 </div>

 @if (!isset($user))
     <div class="row g-3 mb-4">
         <div class="col-md-6">
             <div class="form-floating">
                 <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                 <label>Nova Senha (deixe vazio para manter)</label>
             </div>
         </div>
         <div class="col-md-6">
             <div class="form-floating">
                 <input type="password" name="password_confirmation" class="form-control" >
                 <label>Confirmar Nova Senha</label>
             </div>
         </div>
     </div>
 @endif

 <div class="d-grid gap-2 col-6 mx-auto">
     <button type="submit" class="btn btn-outline-secondary btn-lg">
         <i class="fas fa-save me-2"></i>Atualizar Administrador
     </button>
 </div>
