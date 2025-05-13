const toggleBtn = document.getElementById('toggleDarkMode');

window.onload = function () {
  const darkModeCookie = getCookie('dark_mode');
  if (darkModeCookie === 'true') {
    document.body.classList.add('dark-mode');
    updateToggleIcon(true);
  } else {
    document.body.classList.remove('dark-mode');
    updateToggleIcon(false);
  }
};

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
  return null;
}

function setCookie(name, value, days) {
  const date = new Date();
  date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
  const expires = "expires=" + date.toUTCString();
  document.cookie = `${name}=${value}; ${expires}; path=/`;
}

function updateToggleIcon(isDark) {
  if (!toggleBtn) return;
  toggleBtn.querySelector('i').className = isDark ? 'fas fa-sun' : 'fas fa-moon';
}

if (toggleBtn) {
  toggleBtn.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    const isDark = document.body.classList.contains('dark-mode');
    setCookie('dark_mode', isDark, 30);
    updateToggleIcon(isDark);
  });
}
