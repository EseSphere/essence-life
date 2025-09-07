<?php include 'header-panel.php'; ?>

<div class="container-fluid text-center">
    <h3 class="mb-2 fw-bold text-white">How would you like to wake up?</h3>
    <p class="mb-4 text-light">Tip: Imagine if you didn't struggle sleeping.</p>

    <div class="d-flex flex-column align-items-center gap-3 mb-5">
        <input type="radio" class="btn-check" name="sleepFrequency" id="sleepOccasionally" autocomplete="off">
        <label class="btn btn-outline-primary" for="sleepOccasionally">
            <i class="bi bi-clock-history"></i> Energized and refreshed
        </label>

        <input type="radio" class="btn-check" name="sleepFrequency" id="sleepSometimes" autocomplete="off">
        <label class="btn btn-outline-primary" for="sleepSometimes">
            <i class="bi bi-arrow-repeat"></i> Somewhat rested
        </label>

        <input type="radio" class="btn-check" name="sleepFrequency" id="sleepFrequently" autocomplete="off">
        <label class="btn btn-outline-primary" for="sleepFrequently">
            <i class="bi bi-lightning-fill"></i> No stress
        </label>

        <input type="radio" class="btn-check" name="sleepFrequency" id="sleepNever" autocomplete="off">
        <label class="btn btn-outline-primary" for="sleepNever">
            <i class="bi bi-slash-circle"></i> All of the above
        </label>
    </div>

    <!-- Action Buttons -->
    <div style="margin-top: -30px;" class="d-flex flex-column align-items-center gap-3">
        <button id="submitQuestionnaire" class="action-btn">
            <i class="bi bi-check-circle"></i> Next Step
        </button>

        <a href="./home?&ud=<?= $crackEncryptedbinary ?>" type="button" id="skipQuestionnaire" class="action-btn text-decoration-none">
            <i class="bi bi-skip-forward-circle"></i> Skip for now
        </a>
    </div>

    <div id="selectedAnswers" class="mt-4 text-success fw-medium" style="font-size:1.1rem;"></div>
</div>

<?php include 'footer-panel.php'; ?>