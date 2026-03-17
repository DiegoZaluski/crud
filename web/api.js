const BASE = 'http://localhost:8000';

const api = {

  async getAll() {
    await request('GET', `${BASE}/api/operations`, null, 'res-get-all');
  },

  async getOne() {
    const id   = document.getElementById('get-id').value.trim();
    const name = document.getElementById('get-name').value.trim();
    const param = id ? `?id=${id}` : name ? `?name=${name}` : '';
    const ok = await request('GET', `${BASE}/api/operations${param}`, null, 'res-get-one');
    if (ok) clearFields(['get-id', 'get-name']);
  },

  async create() {
    const body = {
      name:        document.getElementById('post-name').value.trim(),
      age:         Number(document.getElementById('post-age').value),
      description: document.getElementById('post-desc').value.trim(),
    };
    const ok = await request('POST', `${BASE}/api/operations`, body, 'res-post');
    if (ok) clearFields(['post-name', 'post-age', 'post-desc']);
  },

  async update() {
    const id   = document.getElementById('patch-id').value.trim();
    const name = document.getElementById('patch-name').value.trim();
    const age  = document.getElementById('patch-age').value.trim();
    const desc = document.getElementById('patch-desc').value.trim();

    const atualizations = {};
    if (name) atualizations.name        = name;
    if (age)  atualizations.age         = Number(age);
    if (desc) atualizations.description = desc;

    const ok = await request('PATCH', `${BASE}/api/operations?id=${id}`, { atualizations }, 'res-patch');
    if (ok) clearFields(['patch-id', 'patch-name', 'patch-age', 'patch-desc']);
  },

  async remove() {
    const id = document.getElementById('delete-id').value.trim();
    const ok = await request('DELETE', `${BASE}/api/operations?id=${id}`, null, 'res-delete');
    if (ok) clearFields(['delete-id']);
  },

};

async function request(method, url, body, targetId) {
  const box = document.getElementById(targetId);
  box.className   = 'response-box loading';
  box.textContent = 'Running...';

  try {
    const options = {
      method,
      headers: { 'Content-Type': 'application/json' },
    };
    if (body) options.body = JSON.stringify(body);

    const res  = await fetch(url, options);
    const data = await res.json();

    box.className   = res.ok ? 'response-box success' : 'response-box error';
    box.textContent = JSON.stringify(data, null, 2);
    return res.ok;
  } catch (err) {
    box.className   = 'response-box error';
    box.textContent = `Error: ${err.message}`;
    return false;
  }
}

function clearFields(ids) {
  ids.forEach(id => {
    const el = document.getElementById(id);
    if (el) el.value = '';
  });
}