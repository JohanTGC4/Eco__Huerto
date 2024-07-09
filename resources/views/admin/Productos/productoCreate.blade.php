{{-- <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
           
            <form action="{{route('admin.Plantas.plantaCreate')}}" method="POST" enctype="multipart/form-data">
            @csrf
           
            <textarea name="comentario" id="comentario" placeholder="¿Qué quieres compartir hoy?" required></textarea>
            <label for="image-upload" class="upload-label">
                <i class="fas fa-camera"></i> Subir foto
            </label>
            <input type="file" name="image" id="image-upload">
            <div id="image-preview" class="image-preview">
                <img id="preview-image" src="#" alt="Vista previa de la imagen" style="display: none;">
            </div>
            <button type="button " id="post-btn">Publicar</button>
        </form>
       
    </div>
</div> --}}
<style>
    .image-preview {
        max-width: 100%;
        max-height: 100%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain; /* Mantiene la proporción de la imagen */
    }
</style>
<!-- Modal HTML -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="closee">&times;</span>
        <form action="{{ route('productStore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h2>Agregar Producto</h2>
            <div class="form-group">
                <label class="placeholder" for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group" style="display: flex; gap: 10px;">
                <div style="flex: 1;">
                    <label class="placeholder" for="precio">Precio:</label>
                    <input type="number" class="form-control" id="precio" name="precio" required>
                </div>
                <div style="flex: 1;">
                    <label class="placeholder" for="stock">Stock:</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>
            </div>
            <div class="form-group" id="image-preview">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-img" id="upload-imagen" name="imagen">
                <div id="image-preview" class="image-preview">
                    <img id="imgpreview" style="display: none;">
                </div>
            </div>
            <div class="form-group">
                <label class="placeholder" for="descripcion">Descripción:</label>
                <textarea type="textarea" class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
          
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

<script>
// Script para manejar el modal
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('myModal');
    const btn = document.getElementById('open-modal-btn');
    const span = document.getElementsByClassName('closee')[0];

    btn.onclick = function() {
        modal.style.display = 'block';
    }

    span.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    const imageUpload = document.getElementById('upload-imagen');
    const previewImage = document.getElementById('imgpreview');

    // Mostrar la vista previa de la imagen seleccionada
    imageUpload.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                previewImage.src = event.target.result;
                previewImage.style.display = 'block'; // Mostrar la vista previa
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>