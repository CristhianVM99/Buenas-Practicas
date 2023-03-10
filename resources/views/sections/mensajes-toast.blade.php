<div class="flex justify-end toast-container">
    <div class="mensaje-toast"></div>
</div>
<script>
    const success   = @json(session('success'));
    const error     = @json(session('error'));
    const warning   = @json(session('warning'));
    const info      = @json(session('info'));
    const danger    = @json(session('danger'));
</script>