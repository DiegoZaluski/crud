// Tab navigation
document.querySelectorAll('.nav-item').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.nav-item').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(`tab-${btn.dataset.tab}`).classList.add('active');
  });
});

// Run buttons
document.getElementById('btn-get-all').addEventListener('click', e => { e.preventDefault(); api.getAll(); });
document.getElementById('btn-get-one').addEventListener('click', e => { e.preventDefault(); api.getOne(); });
document.getElementById('btn-post').addEventListener('click',    e => { e.preventDefault(); api.create(); });
document.getElementById('btn-patch').addEventListener('click',   e => { e.preventDefault(); api.update(); });
document.getElementById('btn-delete').addEventListener('click',  e => { e.preventDefault(); api.remove(); });

// Server status check
async function checkStatus() {
  const dot  = document.getElementById('statusDot');
  const text = document.getElementById('statusText');
  try {
    await fetch('http://localhost:8000/api/operations', { signal: AbortSignal.timeout(2000) });
    dot.className  = 'status-dot online';
    text.textContent = 'online';
  } catch {
    dot.className  = 'status-dot offline';
    text.textContent = 'offline';
  }
}

checkStatus();
setInterval(checkStatus, 5000);