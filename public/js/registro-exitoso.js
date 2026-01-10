(() => {
  const input = document.getElementById('comprobante');
  const preview = document.getElementById('preview-comprobante');

  if (!input || !preview) return;

  input.addEventListener('change', () => {
    const file = input.files[0];
    preview.innerHTML = '';
    if (!file) return;

    const url = URL.createObjectURL(file);

    if (file.type.startsWith('image/')) {
      const img = document.createElement('img');
      img.src = url;
      img.style.width = '220px';
      img.style.maxWidth = '80vw';
      img.style.marginTop = '8px';
      img.style.borderRadius = '14px';
      img.onload = () => URL.revokeObjectURL(url);
      preview.appendChild(img);
      return;
    }

    if (file.type === 'application/pdf') {
      const embed = document.createElement('embed');
      embed.src = url;
      embed.type = 'application/pdf';
      embed.style.width = '100%';
      embed.style.height = '320px';
      embed.style.marginTop = '8px';
      preview.appendChild(embed);
    }
  });
})();
