<div class="modal fade show" id="{{ $id or '' }}" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" style="text-transform:capitalize !important">
					{{ $title or '' }}
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						×
					</span>
				</button>
			</div>
			<div class="modal-body">
                {{ $form or '' }}
			</div>
			<div class="modal-footer">
                <button type="button" class="btn btn-secondary m-btn--pill" data-dismiss="modal">
					Cancelar
				</button>
			</div>
		</div>
	</div>
</div>
