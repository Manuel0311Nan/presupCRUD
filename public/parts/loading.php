<div class="modal" id="loading" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog m-0">
        <div class="modal-content border-0" style="background-color: transparent!important;">
            <div class="modal-body vh-100 vw-100 min-vw-100 d-flex align-items-center justify-content-center" style="background-color: #0000005c;">
                <div class="spinner-border text-white fs-1" role="status">
                    <!-- <span class="visually-hidden">Loading...</span> -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>var loading = new bootstrap.Modal(document.getElementById('loading'), {keyboard: false,backdrop: 'static'});</script>
<script> function loadingHide(){setTimeout(function(){loading.hide();$(window).scrollTop(0);}, 500)}</script>