    <script>
    import { login, getUser } from '@/api/auth';

    export default {
      name: 'Login',
      data() {
        return {
          email: '',
          password: '',
          error: '',
        };
      },
      methods: {
        async handleLogin() {
          this.error = '';
          try {
            await login({ email: this.email, password: this.password });
            const user = await getUser();
            this.$router.push('/profile');
          } catch (e) {
            this.error = e.message || 'Ошибка входа';
          }
        },
      },
    };
</script>
    
<template>

  <section class="auth-section card shadow-sm p-4">
    <h1 class="mb-4 text-center">Вход</h1>
    <form @submit.prevent="handleLogin" class="auth-form">
      <article class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input v-model="email" type="email" id="email" required class="form-control" />
      </article>
      <article class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input v-model="password" type="password" id="password" required class="form-control" />
      </article>
      <button type="submit" class="btn btn-primary w-100 mt-4">Войти</button>
      <article v-if="error" class="alert alert-danger mt-3" role="alert">{{ error }}</article>
    </form>
    <router-link to="/register" class="correction d-block text-center mt-3 text-decoration-none">Нет аккаунта? Зарегистрируйтесь</router-link>
  </section>

</template>


<style scoped>
.auth-section {
  max-width: 400px;
  margin: 40px auto;
  background: var(--login-auth-bg);
  border-radius: 8px;
  border: 1px solid var(--login-auth-border);

}

h1 {
  color: var(--login-title);
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
