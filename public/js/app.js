document.addEventListener('DOMContentLoaded', () => {
  const themeToggleBtn = document.getElementById('theme-toggle');
  const currentTheme = localStorage.getItem('theme') || 'light';

  if (currentTheme === 'dark') {
    document.documentElement.setAttribute('data-theme', 'dark');
  }

  if (themeToggleBtn) {
    themeToggleBtn.addEventListener('click', () => {
      let theme = document.documentElement.getAttribute('data-theme');
      let newTheme = theme === 'dark' ? 'light' : 'dark';
      document.documentElement.setAttribute('data-theme', newTheme);
      localStorage.setItem('theme', newTheme);
    });
  }

  // Auto Cálculo de IMC en formularios clínicos
  const weightInput = document.getElementById('weight_kg');
  const heightInput = document.getElementById('height_cm');
  const bmiInput = document.getElementById('bmi');

  function calculateBMI() {
    if (weightInput && heightInput && bmiInput) {
      const weight = parseFloat(weightInput.value);
      const height = parseFloat(heightInput.value) / 100;
      if (weight > 0 && height > 0) {
        const bmi = (weight / (height * height)).toFixed(2);
        bmiInput.value = bmi;
      }
    }
  }

  if (weightInput && heightInput) {
    weightInput.addEventListener('input', calculateBMI);
    heightInput.addEventListener('input', calculateBMI);
  }
});