document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('timeInput').value;
    let QuestionSubmit = document.getElementById('QuestionSubmit');
    let endBtn = document.getElementById('endBtn');
    const [hours, minutes] = input.split(':').map(Number);

    if (isNaN(hours) || isNaN(minutes) || hours < 0 || minutes < 0 || minutes >= 60) {
        endBtn.click();
        return;
    }

    let totalSeconds = (hours * 3600) + (minutes * 60);
    const timerDisplay = document.getElementById('timerDisplay');

    const interval = setInterval(() => {
        if (totalSeconds <= 0) {
            clearInterval(interval);
            if (QuestionSubmit) {
                QuestionSubmit.click();
            }
            timerDisplay.textContent = "";
            return;
        }

        totalSeconds--;

        const remainingHours = Math.floor(totalSeconds / 3600);
        const remainingMinutes = Math.floor((totalSeconds % 3600) / 60);
        const remainingSeconds = totalSeconds % 60;
        timerDisplay.textContent = `${String(remainingHours).padStart(2, '0')}:${String(remainingMinutes).padStart(2, '0')}:${String(remainingSeconds).padStart(2, '0')}`;
    }, 1000);
})