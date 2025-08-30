<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Essence – Set New Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        .wrapper {
            position: relative;
            min-height: 100vh;
            background: linear-gradient(-45deg, #0d6efd, #198754, #6c757d, #000000);
            background-size: 400% 400%;
            animation: gradientShift 20s ease infinite;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        .particle {
            position: absolute;
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 50%;
            top: 0;
            left: 0;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
        }

        .app-header {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
        }

        .app-header h1 {
            font-size: 2rem;
            font-weight: 600;
            text-shadow: rgba(0, 0, 0, 0.5) 0px 5px 20px;
        }

        .newpass-form {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            max-width: 400px;
            width: 100%;
            color: #fff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
        }

        .btn-newpass {
            background: linear-gradient(135deg, #0d6efd, #198754);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px;
            width: 100%;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-newpass:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        }

        .extra-links {
            margin-top: 15px;
            text-align: center;
        }

        .extra-links a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 500;
        }

        .extra-links a:hover {
            color: #198754;
        }

        /* Modal styling */
        .modal-content {
            border-radius: 15px;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>

        <div class="app-header">
            <h1>Essence</h1>
        </div>

        <div class="newpass-form">
            <h3 class="text-center">Set New Password</h3>
            <p class="text-center" style="font-size:0.9rem;">Enter your new password below.</p>
            <form id="newPassForm">
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="New Password" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Confirm New Password" required>
                </div>
                <button type="submit" class="btn-newpass">Update Password</button>
            </form>
            <div class="extra-links">
                <p><a href="login.html">Back to Log In</a></p>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title"><i class="bi bi-check-circle-fill text-success"></i> Success</h5>
                </div>
                <div class="modal-body">
                    <p>Your password has been updated successfully!</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href="login.html" class="btn btn-success">Go to Login</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script>
        // Particles animation
        const particles = document.querySelectorAll('.particle');

        function animateParticles() {
            const centerX = window.innerWidth / 2,
                centerY = window.innerHeight / 2;
            particles.forEach(p => {
                gsap.set(p, {
                    x: centerX,
                    y: centerY,
                    scale: Math.random() + 0.5,
                    opacity: Math.random() * 0.5 + 0.3
                });
                gsap.to(p, {
                    x: () => centerX + (Math.random() - 0.5) * window.innerWidth * 0.8,
                    y: () => centerY + (Math.random() - 0.5) * window.innerHeight * 0.8,
                    duration: () => 10 + Math.random() * 15,
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut",
                    delay: Math.random() * 5
                });
            });
        }
        animateParticles();
        window.addEventListener('resize', animateParticles);

        // Form handling
        document.getElementById("newPassForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById("successModal"));
            modal.show();
        });
    </script>
</body>

</html>