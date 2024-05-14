@extends("layouts.admin.app")
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alertBox">
                    <div class="alertIcon">
                        <iconify-icon icon="ion:alert-circle-outline"></iconify-icon>
                    </div>
                    <p>Are you sure you want to delete this item?</p>
                    <div class="alertBtn">
                        {!! html()->form('DELETE')->attributes(['id' => 'delete-form'])->open() !!}
                        <button class="finalDelete" type="button">Delete</button>
                        {!! html()->form()->close() !!}
                        <button class="cancel" data-bs-dismiss="modal" aria-label="Close" class="btn-close">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push("scripts")
<!-- listing page js -->
@endpush