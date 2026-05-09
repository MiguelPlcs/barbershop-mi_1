<x-app-layout>
<div style="display:flex; min-height:calc(100vh - 64px); background:#F4F6F9; font-family:'Outfit',sans-serif;">

    @include('admin._sidebar')

    <div style="flex:1; overflow-x:hidden;">
        {{-- Page Header --}}
        <div style="background:#fff; border-bottom:3px solid #1565C0; padding:20px 32px; display:flex; align-items:center; gap:12px;">
            <a href="{{ route('admin.productos.index') }}" style="width:36px; height:36px; background:#F4F6F9; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#6B7280; text-decoration:none; transition:all .2s; flex-shrink:0;" onmouseover="this.style.background='#E8ECF0'; this.style.color='#111827'" onmouseout="this.style.background='#F4F6F9'; this.style.color='#6B7280'">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 style="margin:0; font-size:1.4rem; font-weight:800; color:#111827; display:flex; align-items:center; gap:10px;">
                    <i class="fas fa-plus-circle" style="color:#1565C0;"></i> Crear Producto
                </h1>
                <p style="margin:4px 0 0; font-size:0.83rem; color:#6B7280;">
                    <a href="{{ route('admin.dashboard') }}" style="color:#1565C0; text-decoration:none;">Dashboard</a>
                    <i class="fas fa-chevron-right" style="font-size:0.7rem; margin:0 4px;"></i>
                    <a href="{{ route('admin.productos.index') }}" style="color:#1565C0; text-decoration:none;">Productos</a>
                    <i class="fas fa-chevron-right" style="font-size:0.7rem; margin:0 4px;"></i> Crear
                </p>
            </div>
        </div>

        <div style="padding:28px 32px;">
            <div style="max-width:680px; margin:0 auto;">
                <div style="background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.07);">

                    <div style="background:#111827; padding:16px 24px; display:flex; align-items:center; gap:10px;">
                        <i class="fas fa-box" style="color:#1976D2;"></i>
                        <span style="color:#fff; font-weight:700; font-size:1rem;">Información del producto</span>
                    </div>

                    <div style="padding:28px;">
                        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if($errors->any())
                            <div style="background:rgba(198,40,40,0.08); border:1px solid rgba(198,40,40,0.25); border-radius:12px; padding:14px 18px; margin-bottom:24px; color:#C62828; font-size:0.9rem;">
                                <div style="font-weight:700; margin-bottom:6px; display:flex; align-items:center; gap:8px;"><i class="fas fa-circle-exclamation"></i> Por favor corrige los errores:</div>
                                <ul style="margin:0; padding-left:18px;">
                                    @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                                </ul>
                            </div>
                            @endif

                            {{-- Nombre --}}
                            <div style="margin-bottom:20px;">
                                <label style="display:block; font-weight:600; font-size:0.88rem; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.04em;">
                                    <i class="fas fa-tag" style="color:#1565C0; margin-right:5px;"></i> Nombre *
                                </label>
                                <input type="text" name="nombre" value="{{ old('nombre') }}" required placeholder="Ej: Cera para cabello"
                                    style="width:100%; padding:13px 16px; border:2px solid {{ $errors->has('nombre') ? '#C62828' : '#E8ECF0' }}; border-radius:12px; font-family:'Outfit',sans-serif; font-size:0.95rem; color:#111827; background:#fff; outline:none; box-sizing:border-box; transition:border-color .2s, box-shadow .2s;"
                                    onfocus="this.style.borderColor='#1565C0'; this.style.boxShadow='0 0 0 4px rgba(21,101,192,0.12)'"
                                    onblur="this.style.borderColor='#E8ECF0'; this.style.boxShadow='none'">
                                @if($errors->has('nombre'))<p style="color:#C62828; font-size:0.83rem; margin:5px 0 0;"><i class="fas fa-circle-exclamation"></i> {{ $errors->first('nombre') }}</p>@endif
                            </div>

                            {{-- Descripción --}}
                            <div style="margin-bottom:20px;">
                                <label style="display:block; font-weight:600; font-size:0.88rem; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.04em;">
                                    <i class="fas fa-align-left" style="color:#1565C0; margin-right:5px;"></i> Descripción *
                                </label>
                                <textarea name="descripcion" required rows="3" placeholder="Describe el producto..."
                                    style="width:100%; padding:13px 16px; border:2px solid {{ $errors->has('descripcion') ? '#C62828' : '#E8ECF0' }}; border-radius:12px; font-family:'Outfit',sans-serif; font-size:0.95rem; color:#111827; background:#fff; outline:none; box-sizing:border-box; resize:vertical; transition:border-color .2s;"
                                    onfocus="this.style.borderColor='#1565C0'; this.style.boxShadow='0 0 0 4px rgba(21,101,192,0.12)'"
                                    onblur="this.style.borderColor='#E8ECF0'; this.style.boxShadow='none'">{{ old('descripcion') }}</textarea>
                            </div>

                            {{-- Precio + Stock --}}
                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">
                                <div>
                                    <label style="display:block; font-weight:600; font-size:0.88rem; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.04em;">
                                        <i class="fas fa-dollar-sign" style="color:#1565C0; margin-right:5px;"></i> Precio *
                                    </label>
                                    <input type="number" name="precio" value="{{ old('precio') }}" step="0.01" min="0" required placeholder="0.00"
                                        style="width:100%; padding:13px 16px; border:2px solid #E8ECF0; border-radius:12px; font-family:'Outfit',sans-serif; font-size:0.95rem; color:#111827; background:#fff; outline:none; box-sizing:border-box; transition:border-color .2s;"
                                        onfocus="this.style.borderColor='#1565C0'; this.style.boxShadow='0 0 0 4px rgba(21,101,192,0.12)'"
                                        onblur="this.style.borderColor='#E8ECF0'; this.style.boxShadow='none'">
                                </div>
                                <div>
                                    <label style="display:block; font-weight:600; font-size:0.88rem; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.04em;">
                                        <i class="fas fa-warehouse" style="color:#1565C0; margin-right:5px;"></i> Stock *
                                    </label>
                                    <input type="number" name="stock" value="{{ old('stock') }}" min="0" required placeholder="0"
                                        style="width:100%; padding:13px 16px; border:2px solid #E8ECF0; border-radius:12px; font-family:'Outfit',sans-serif; font-size:0.95rem; color:#111827; background:#fff; outline:none; box-sizing:border-box; transition:border-color .2s;"
                                        onfocus="this.style.borderColor='#1565C0'; this.style.boxShadow='0 0 0 4px rgba(21,101,192,0.12)'"
                                        onblur="this.style.borderColor='#E8ECF0'; this.style.boxShadow='none'">
                                </div>
                            </div>

                            {{-- Categoría --}}
                            <div style="margin-bottom:20px;">
                                <label style="display:block; font-weight:600; font-size:0.88rem; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.04em;">
                                    <i class="fas fa-folder" style="color:#1565C0; margin-right:5px;"></i> Categoría
                                </label>
                                <input list="categorias-list" name="categoria" value="{{ old('categoria') }}" placeholder="Ej: Ceras, Máquinas, Capas..."
                                    style="width:100%; padding:13px 16px; border:2px solid #E8ECF0; border-radius:12px; font-family:'Outfit',sans-serif; font-size:0.95rem; color:#111827; background:#fff; outline:none; box-sizing:border-box; transition:border-color .2s;"
                                    onfocus="this.style.borderColor='#1565C0'; this.style.boxShadow='0 0 0 4px rgba(21,101,192,0.12)'"
                                    onblur="this.style.borderColor='#E8ECF0'; this.style.boxShadow='none'">
                                <datalist id="categorias-list">
                                    @if(isset($categorias)) @foreach($categorias as $c) <option value="{{ $c }}"> @endforeach @endif
                                </datalist>
                            </div>

                            {{-- Imagen --}}
                            <div style="margin-bottom:28px;">
                                <label style="display:block; font-weight:600; font-size:0.88rem; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.04em;">
                                    <i class="fas fa-image" style="color:#1565C0; margin-right:5px;"></i> Imagen del producto
                                </label>
                                <div style="border:2px dashed #E8ECF0; border-radius:12px; padding:24px; text-align:center; transition:border-color .2s;" id="drop-zone">
                                    <i class="fas fa-cloud-arrow-up" style="font-size:2rem; color:#9AA7B6; margin-bottom:10px; display:block;"></i>
                                    <p style="margin:0 0 10px; color:#6B7280; font-size:0.9rem;">Arrastra una imagen o haz clic para seleccionar</p>
                                    <input type="file" name="imagen" accept="image/*" id="img-input" style="display:none;" onchange="previewImg(this)">
                                    <label for="img-input" style="display:inline-flex; align-items:center; gap:6px; padding:8px 18px; background:#F4F6F9; border-radius:8px; cursor:pointer; font-size:0.88rem; font-weight:600; color:#374151; border:1px solid #E8ECF0;">
                                        <i class="fas fa-folder-open"></i> Seleccionar archivo
                                    </label>
                                    <img id="img-preview" src="" alt="" style="display:none; max-height:120px; margin:14px auto 0; border-radius:10px; display:none;">
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div style="display:flex; gap:12px; justify-content:flex-end;">
                                <a href="{{ route('admin.productos.index') }}" style="display:inline-flex; align-items:center; gap:8px; padding:12px 22px; background:#F4F6F9; color:#374151; border-radius:12px; text-decoration:none; font-weight:600; border:2px solid #E8ECF0; transition:all .2s;" onmouseover="this.style.background='#E8ECF0'" onmouseout="this.style.background='#F4F6F9'">
                                    <i class="fas fa-times"></i> Cancelar
                                </a>
                                <button type="submit" style="display:inline-flex; align-items:center; gap:8px; padding:12px 28px; background:#1565C0; color:#fff; border-radius:12px; border:none; font-family:'Outfit',sans-serif; font-size:1rem; font-weight:700; cursor:pointer; box-shadow:0 4px 16px rgba(21,101,192,0.3); transition:all .2s;" onmouseover="this.style.background='#1976D2'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#1565C0'; this.style.transform='translateY(0)'">
                                    <i class="fas fa-save"></i> Crear Producto
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImg(input) {
    const preview = document.getElementById('img-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</x-app-layout>