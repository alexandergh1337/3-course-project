<script>
import { register, getUser } from '@/api/auth';

export default {
  name: 'Register',
  data() {
    return {
      name: '',
      email: '',
      phone: '',
      password: '',
      password_confirmation: '',
      error: '',
    };
  },
  methods: {
    async handleRegister() {
      this.error = '';
      try {
        await register({
          name: this.name,
          email: this.email,
          phone: this.phone,
          password: this.password,
          password_confirmation: this.password_confirmation,
        });
        await getUser();
        this.$router.push('/profile');
      } catch (e) {
        this.error = e.message || (e.errors && Object.values(e.errors).flat().join(', ')) || 'Ошибка регистрации';
      }
    },
  },
};
</script>

<template>

  <section class="auth-section card shadow-sm p-4">
    <h1 class="mb-4 text-center">Регистрация</h1>
    <form @submit.prevent="handleRegister" class="auth-form">
      <article class="mb-3">
        <label for="name" class="form-label">Имя</label>
        <input v-model="name" type="text" id="name" required class="form-control" />
      </article>
      <article class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input v-model="email" type="email" id="email" required class="form-control" />
      </article>
      <article class="mb-3">
        <label for="phone" class="form-label">Телефон</label>
        <input v-model="phone" type="tel" id="phone" required class="form-control" />
      </article>
      <article class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input v-model="password" type="password" id="password" required class="form-control" />
      </article>
      <article class="mb-3">
        <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
        <input v-model="password_confirmation" type="password" id="password_confirmation" required
          class="form-control" />
      </article>
      <button type="submit" class="btn btn-primary w-100 mt-4">Зарегистрироваться</button>
      <article v-if="error" class="alert alert-danger mt-3" role="alert">{{ error }}</article>
    </form>
    <router-link to="/login" class="correction d-block text-center mt-3 text-decoration-none">Уже есть аккаунт?
      Войти</router-link>
  </section>

</template>


<style scoped>
.auth-section {
  max-width: 400px;
  margin: 40px auto;
  background: var(--register-auth-bg);
  border-radius: 8px;
  border: 1px solid var(--register-auth-border);
}

h1 {
  color: var(--register-title);
}

.form-label {
  color: var(--form-label);
}

.form-control {
  background-color: var(--input-bg);
  color: var(--input-text);
  border-color: var(--input-border);
}

.form-control:focus {
  background-color: var(--input-bg);
  color: var(--input-text);
  border-color: var(--input-focus-border);
  box-shadow: 0 0 0 0.2rem var(--input-focus-shadow);
}

.correction {
  color: var(--correction-text);

}
</style>
