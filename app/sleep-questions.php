<?php include 'header-panel.php'; ?>
<div class="container-fluid text-center">
    <h3 class="mb-2 fw-bold text-white">Do you often struggle to sleep?</h3>
    <p class="mb-4 text-light">Select all that apply to you</p>

    <div class="d-flex flex-column align-items-center gap-3 mb-5">
        <input type="radio" class="btn-check" name="sleepFrequency" id="sleepOccasionally" autocomplete="off">
        <label class="btn btn-outline-primary" for="sleepOccasionally">
            <i class="bi bi-clock-history"></i> Occasionally
        </label>

        <input type="radio" class="btn-check" name="sleepFrequency" id="sleepSometimes" autocomplete="off">
        <label class="btn btn-outline-primary" for="sleepSometimes">
            <i class="bi bi-arrow-repeat"></i> Sometimes
        </label>

        <input type="radio" class="btn-check" name="sleepFrequency" id="sleepFrequently" autocomplete="off">
        <label class="btn btn-outline-primary" for="sleepFrequently">
            <i class="bi bi-lightning-fill"></i> Frequently
        </label>

        <input type="radio" class="btn-check" name="sleepFrequency" id="sleepNever" autocomplete="off">
        <label class="btn btn-outline-primary" for="sleepNever">
            <i class="bi bi-slash-circle"></i> Never
        </label>
    </div>

    <!-- Action Buttons -->
    <div style="margin-top: -30px;" class="d-flex flex-column align-items-center gap-3">
        <button id="submitQuestionnaire" class="action-btn">
            <i class="bi bi-check-circle"></i> Next Step
        </button>

        <a href="./sleep-questions2?&ud=<?= $crackEncryptedbinary ?>" type="button" id="skipQuestionnaire" class="action-btn text-decoration-none">
            <i class="bi bi-skip-forward-circle"></i> Skip for now
        </a>
    </div>

    <div id="selectedAnswers" class="mt-4 text-success fw-medium" style="font-size:1.1rem;"></div>
</div>

<?php include 'footer-panel.php'; ?>