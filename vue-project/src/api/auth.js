const API_URL = 'http://localhost:8000';

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}

export async function register({ name, email, phone, password, password_confirmation }) {
  await fetch(`${API_URL}/sanctum/csrf-cookie`, { credentials: 'include' });
  const xsrfToken = getCookie('XSRF-TOKEN');
  const response = await fetch(`${API_URL}/register`, {
    method: 'POST',
    credentials: 'include',
    headers: {
      'Content-Type': 'application/json',
      'X-XSRF-TOKEN': xsrfToken ? decodeURIComponent(xsrfToken) : ''
    },
    body: JSON.stringify({ name, email, phone, password, password_confirmation }),
  });
  if (!response.ok) throw await response.json();
  return response.status === 204 ? true : await response.json();
}

export async function login({ email, password }) {
  await fetch(`${API_URL}/sanctum/csrf-cookie`, { credentials: 'include' });
  const xsrfToken = getCookie('XSRF-TOKEN');
  const response = await fetch(`${API_URL}/login`, {
    method: 'POST',
    credentials: 'include',
    headers: {
      'Content-Type': 'application/json',
      'X-XSRF-TOKEN': xsrfToken ? decodeURIComponent(xsrfToken) : ''
    },
    body: JSON.stringify({ email, password }),
  });
  if (!response.ok) throw await response.json();
  return response.status === 204 ? true : await response.json();
}

export async function getUser() {
  const response = await fetch(`${API_URL}/api/user`, {
    credentials: 'include',
  });
  if (!response.ok) throw await response.json();
  return await response.json();
}

export async function logout() {
  await fetch(`${API_URL}/sanctum/csrf-cookie`, { credentials: 'include' });
  const xsrfToken = getCookie('XSRF-TOKEN');
  await fetch(`${API_URL}/logout`, {
    method: 'POST',
    credentials: 'include',
    headers: {
      'Content-Type': 'application/json',
      'X-XSRF-TOKEN': xsrfToken ? decodeURIComponent(xsrfToken) : ''
    }
  });
}

export async function updateUser({ name, email, phone }) {
  await fetch(`${API_URL}/sanctum/csrf-cookie`, { credentials: 'include' });
  const xsrfToken = getCookie('XSRF-TOKEN');
  const response = await fetch(`${API_URL}/api/user`, {
    method: 'PATCH',
    credentials: 'include',
    headers: {
      'Content-Type': 'application/json',
      'X-XSRF-TOKEN': xsrfToken ? decodeURIComponent(xsrfToken) : ''
    },
    body: JSON.stringify({ name, email, phone }),
  });
  if (!response.ok) throw await response.json();
  return await response.json();
}
