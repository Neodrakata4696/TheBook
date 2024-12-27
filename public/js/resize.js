function resizeTextarea(el) {
  const dummy = el.querySelector('.dummy_textarea')
  el.querySelector('.retextarea').addEventListener('input', e => {
    dummy.textContent = e.target.value + '\u200b'
  })
}

document.querySelectorAll('.textboard').forEach(resizeTextarea)
