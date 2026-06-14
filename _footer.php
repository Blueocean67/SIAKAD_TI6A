 </div>

<footer class="mt-5 py-4 text-center position-relative" style="
    background: linear-gradient(135deg, #2563eb, #1e40af);
    color: white;
    border-radius: 24px 24px 0 0;
    box-shadow: 0 -8px 25px rgba(37, 99, 235, 0.15);
">
    <div class="container">
        <h6 class="fw-bold mb-2">
            <i class="bi bi-mortarboard-fill me-2"></i>SIAKAD | TI-6A
        </h6>

        <p class="mb-1 opacity-75">
            Sistem Informasi Akademik Universitas Al-Khairiyah
        </p>

        <small class="opacity-50">
            © <?= date('Y'); ?> TI-6A 
            <i class="bi bi-heart-fill text-danger"></i> 
        </small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
crossorigin="anonymous"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.body.style.opacity = "0";
        document.body.style.transition = "opacity 0.5s ease";
        setTimeout(() => {
            document.body.style.opacity = "1";
        }, 100);
    });
</script>

</body>
</html>