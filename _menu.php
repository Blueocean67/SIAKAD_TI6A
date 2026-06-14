<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            <i class="bi bi-mortarboard-fill me-2"></i>SIAKAD TI-6A
        </a>

        <button class="navbar-toggler border-0 shadow-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation">

            <i class="bi bi-list fs-2 text-white"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                <li class="nav-item">
                    <a class="nav-link active-nav" href="index.php">
                        <i class="bi bi-house-door me-1"></i>Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="prodi.php">
                        <i class="bi bi-mortarboard me-1"></i>Program Studi
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="mahasiswa.php">
                        <i class="bi bi-people me-1"></i>Mahasiswa
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar-custom {
        background: linear-gradient(135deg, #2563eb, #1e40af);
        padding: 14px 0;
        box-shadow: 0 8px 24px rgba(37, 99, 235, 0.18);
    }

    .navbar-brand {
        color: white !important;
        font-size: 1.35rem;
        letter-spacing: .5px;
    }

    .nav-link {
        color: rgba(255,255,255,0.85) !important;
        font-weight: 500;
        padding: 10px 18px !important;
        border-radius: 12px;
        transition: .25s ease;
    }

    .nav-link:hover {
        background: rgba(255,255,255,0.12);
        color: white !important;
        transform: translateY(-2px);
    }

    .active-nav {
        background: rgba(255,255,255,0.18);
        color: white !important;
        font-weight: 600;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    @media (max-width: 991px) {
        .navbar-nav {
            margin-top: 15px;
            gap: 8px;
        }

        .nav-link {
            padding: 12px !important;
        }
    }
</style>