article<script>
import { gsap } from "gsap";

export default {
    data() {
        return {
            name: '',
            email: '',
            message: '',
            showAlert: false,
            alertTimeout: null,
            remainingTime: 10000,
            startTime: null,
            elapsedTime: 0
        };
    },
    methods: {
        handleSubmit() {
            this.showAlert = true;
            this.startTime = Date.now();
            this.elapsedTime = 0;
            this.setAlertTimeout();

            this.name = '';
            this.email = '';
            this.message = '';

            this.$nextTick(() => {
                gsap.fromTo(".custom-alert", { opacity: 0, y: 50 }, { opacity: 1, y: 0, duration: 0.5 });
            });
        },
        setAlertTimeout() {
            this.alertTimeout = setTimeout(() => {
                this.closeAlert();
            }, this.remainingTime - this.elapsedTime);
        },
        closeAlert() {
            gsap.to(".custom-alert", {
                opacity: 0, y: 50, duration: 0.5, onComplete: () => {
                    this.showAlert = false;
                    clearTimeout(this.alertTimeout);
                    this.elapsedTime = 0;
                }
            });
        },
        pauseAlert() {
            clearTimeout(this.alertTimeout);
            this.elapsedTime = Date.now() - this.startTime;
        },
        resumeAlert() {
            this.setAlertTimeout();
            this.startTime = Date.now();
        }
    }
};
</script>


<template>
    <section class="contact-section">
        <article class="container">
            <h2>Свяжитесь с нами</h2>
            <form @submit.prevent="handleSubmit">
                <article class="mb-3">
                    <label for="name" class="form-label">Ваше имя</label>
                    <input type="text" class="form-control" v-model="name" placeholder="Введите ваше имя" required>
                </article>
                <article class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" v-model="email" placeholder="Введите ваш email" required>
                </article>
                <article class="mb-3">
                    <label for="message" class="form-label">Сообщение</label>
                    <textarea class="form-control" v-model="message" rows="3" placeholder="Введите ваше сообщение"
                        required></textarea>
                </article>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>

            <article v-if="showAlert" class="alert alert-success alert-dismissible custom-alert" role="alert"
                @mouseover="pauseAlert" @mouseleave="resumeAlert">
                <strong>Успех!</strong> Ваше сообщение отправлено.
                <button type="button" class="btn-close" @click="closeAlert" aria-label="Close"></button>
            </article>
        </article>
    </section>
</template>

<style scoped>
.contact-section {
    background-color: var(--form-bg);
    padding: 4rem 0;
    margin: 0;
}

.container {
    margin: 0 auto;
    padding: 0 1rem;
}

h2 {
    color: var(--form-title);
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

.btn-primary {
    background-color: var(--button-bg);
    border-color: var(--button-bg);
    color: var(--button-text);
}

.btn-primary:hover {
    background-color: var(--button-hover-bg);
    border-color: var(--button-hover-bg);
}

.custom-alert {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1050;
    width: 300px;
    background-color: var(--alert-success-bg);
    color: var(--alert-success-text);
    border-color: var(--alert-success-border);
}

.custom-alert .btn-close {
    filter: var(--icon-filter);
}

.form-control::placeholder {
    color: var(--input-placeholder);
    opacity: 1;
}
</style>