</section>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="script.js"></script>
<script>
    AOS.init();

    const particles = document.querySelectorAll('.particle');

    function animateParticles() {
        const centerX = window.innerWidth / 2;
        const centerY = window.innerHeight / 2;
        particles.forEach(p => {
            gsap.set(p, {
                x: centerX,
                y: centerY,
                scale: Math.random() * 1 + 0.5,
                opacity: Math.random() * 0.5 + 0.3
            });
            gsap.to(p, {
                x: () => centerX + (Math.random() - 0.5) * window.innerWidth * 0.8,
                y: () => centerY + (Math.random() - 0.5) * window.innerHeight * 0.8,
                scale: () => Math.random() * 1 + 0.5,
                opacity: () => Math.random() * 0.5 + 0.3,
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

    document.getElementById('submitQuestionnaire').addEventListener('click', () => {
        const selected = [];
        document.querySelectorAll('#questionnaire input[type=checkbox]').forEach(cb => {
            if (cb.checked) selected.push(cb.nextElementSibling.textContent);
        });

        const sleepFrequency = document.querySelector('input[name="sleepFrequency"]:checked');
        if (sleepFrequency) selected.push('Sleep Frequency: ' + sleepFrequency.nextElementSibling.textContent);

        const display = selected.length > 0 ? 'You selected: ' + selected.join(', ') : 'No selection made';
        document.getElementById('selectedAnswers').textContent = display;
    });

    document.getElementById('skipQuestionnaire').addEventListener('click', () => {
        document.getElementById('selectedAnswers').textContent = 'Skipped';
        document.querySelectorAll('#questionnaire input[type=checkbox]').forEach(cb => cb.checked = false);
        document.querySelectorAll('#questionnaire input[type=radio]').forEach(rb => rb.checked = false);
    });
</script>
</body>

</html>