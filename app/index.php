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
              <h4 class="mb-4 pb-3 text-white">Log In</h4>

              <!-- Alert container -->
              <div id="alertContainer" class="alert-container"></div>

              <form id="submitForm" autocomplete="off">
                <div class="form-group">
                  <input type="email" required name="logemail" class="form-style" placeholder="Email" id="logemail" autocomplete="off">
                  <i class="input-icon uil uil-at"></i>
                </div>
                <div class="form-group mt-2">
                  <input type="password" required name="logpass" class="form-style" placeholder="Password" id="logpass" autocomplete="off">
                  <i class="input-icon uil uil-lock-alt"></i>
                </div>
                <div class="form-group mt-2">
                  <button type="submit" id="btnSubmitForm" class="action-btn mt-3"><i class="bi bi-sign-in"></i> Sign In</button>
                </div>
                <div class="row">
                  <div class="col-6">
                    <p class="mb-0 mt-4 text-center"><a href="./reset-password" class="link">Forgot password?</a></p>
                  </div>
                  <div class="col-6">
                    <p class="mb-0 mt-4 text-center"><a href="./signup" class="link">Don't have account?</a></p>
                  </div>
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
    let db;

    const request = indexedDB.open('essence_life');

    request.onsuccess = (event) => {
      db = event.target.result;
    };

    request.onerror = (event) => {
      showAlert('Database error: ' + event.target.errorCode, 'danger');
    };

    form.addEventListener('submit', function(e) {
      e.preventDefault();

      const email = document.getElementById('logemail').value.trim();
      const password = document.getElementById('logpass').value.trim();
      const hashedPassword = btoa(password);

      if (!db) {
        showAlert('Database not ready. Please try again.', 'danger');
        return;
      }

      const transaction = db.transaction(['users'], 'readonly');
      const objectStore = transaction.objectStore('users');

      // Check if email index exists
      if (objectStore.indexNames.contains('email')) {
        const index = objectStore.index('email');
        const getRequest = index.get(email);

        getRequest.onsuccess = () => {
          const user = getRequest.result;
          if (user && user.password === hashedPassword) {
            window.location.href = 'question.php';
          } else {
            showAlert('Email or password is incorrect.', 'danger');
          }
        };

        getRequest.onerror = () => {
          showAlert('Error reading user data.', 'danger');
        };
      } else {
        // Fallback: scan all users
        let found = false;
        const cursorRequest = objectStore.openCursor();
        cursorRequest.onsuccess = (event) => {
          const cursor = event.target.result;
          if (cursor) {
            const user = cursor.value;
            if (user.email === email && user.password === hashedPassword) {
              found = true;
              window.location.href = 'question.php';
              return;
            }
            cursor.continue();
          } else {
            if (!found) showAlert('Email or password is incorrect.', 'danger');
          }
        };
        cursorRequest.onerror = () => {
          showAlert('Error scanning users.', 'danger');
        };
      }
    });

    function showAlert(message, type = 'success') {
      alertContainer.innerHTML = '';
      const alertDiv = document.createElement('div');
      alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
      alertDiv.role = 'alert';
      alertDiv.innerHTML = `
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
      alertContainer.appendChild(alertDiv);
    }
  });
</script>

<?php require_once('footer-panel.php'); ?>