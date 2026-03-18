<!-- Modal -->
<div class="modal fade" id="TerminosModal" tabindex="-1" aria-labelledby="TerminosModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="TerminosModalLabel">Términos y condiciones</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <iframe src="<?=funciones_strategix_version_url_random_base_url("application/views/template/login/legal/Axalta_Términos_y_Condiciones.pdf");?>" width="100%" height="600px"></iframe>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btncancelmodaltc">Cerrar</button>
      </div>
    </div>
  </div>
</div>