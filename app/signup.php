<?php require_once('header-panel.php'); ?>
<style>
    #submitQuestionnaire,
    #btnSubmitForm {
        background: linear-gradient(135deg, #0d6efd, #198754);
        color: #fff;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
    }

    #submitQuestionnaire:hover,
    #btnSubmitForm:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.4);
    }

    .alert-container {
        margin-bottom: 1rem;
    }
</style>

<div class="section pt-5 text-center">
    <div class="container-fluid">
        <div class="card-3d-wrap mx-auto">
            <div class="card-3d-wrapper">
                <div class="card-front">
                    <div class="center-wrap">
                        <div class="section text-center">
                            <h4 class="mb-4 pb-3 text-white">Sign Up</h4>

                            <!-- Alert container -->
                            <div id="alertContainer" class="alert-container"></div>

                            <form id="submitForm" autocomplete="off">
                                <div class="form-group">
                                    <input type="text" required name="logname" class="form-style" placeholder="Full Name" id="logname" autocomplete="off">
                                    <i class="input-icon uil uil-user"></i>
                                </div>
                                <div class="form-group mt-2">
                                    <input type="email" required name="logemail" class="form-style" placeholder="Email" id="logemail" autocomplete="off">
                                    <i class="input-icon uil uil-at"></i>
                                </div>
                                <div class="form-group mt-2">
                                    <input type="password" required name="logpass" class="form-style" placeholder="Password" id="logpass" autocomplete="off">
                                    <i class="input-icon uil uil-lock-alt"></i>
                                </div>
                                <div class="form-group mt-2">
                                    <button type="submit" id="btnSubmitForm" class="action-btn mt-3"><i class="bi bi-sign-in"></i> Sign Up</button>
                                </div>
                                <div class="form-group mt-2 w-100 flex justify-start items-start text-start">
                                    <p class="mb-0 mt-4 text-left"><a href="./" class="link">Have account? Login</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('submitForm');
        const alertContainer = document.getElementById('alertContainer');

        // Open the existing IndexedDB database "essence_life"
        let db;
        const request = indexedDB.open('essence_life');

        request.onsuccess = function(event) {
            db = event.target.result;
        };

        request.onerror = function(event) {
            console.error('IndexedDB error:', event.target.errorCode);
        };

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('logname').value.trim();
            const email = document.getElementById('logemail').value.trim();
            const password = document.getElementById('logpass').value;

            // Simple password hashing (base64 encoding)
            const hashedPassword = btoa(password);

            const user_id = 'user_' + Date.now();
            const updated_at = new Date().toISOString().split('T')[0];

            const transaction = db.transaction(['users'], 'readwrite');
            const objectStore = transaction.objectStore('users');

            const newUser = {
                user_id,
                name,
                email,
                phone: '',
                password: hashedPassword,
                updated_at
            };

            const requestAdd = objectStore.add(newUser);

            requestAdd.onsuccess = function() {
                // Clear any existing alert
                alertContainer.innerHTML = '';

                // Create Bootstrap alert div
                const successAlert = document.createElement('div');
                successAlert.className = 'alert alert-success alert-dismissible fade show';
                successAlert.role = 'alert';
                successAlert.innerHTML = `
                Sign up successful!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;

                alertContainer.appendChild(successAlert);

                // Reset the form
                form.reset();
            };

            requestAdd.onerror = function(e) {
                alertContainer.innerHTML = '';
                const errorAlert = document.createElement('div');
                errorAlert.className = 'alert alert-danger alert-dismissible fade show';
                errorAlert.role = 'alert';
                errorAlert.innerHTML = `
                Error: ${e.target.error}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
                alertContainer.appendChild(errorAlert);
            };
        });
    });
</script>

<?php require_once('footer-panel.php'); ?>