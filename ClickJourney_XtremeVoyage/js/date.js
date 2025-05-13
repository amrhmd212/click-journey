
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('departure-date').setAttribute('min', today);
    document.getElementById('return-date').setAttribute('min', today);
