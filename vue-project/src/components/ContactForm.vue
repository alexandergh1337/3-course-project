<script>
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
        },
        setAlertTimeout() {
            this.alertTimeout = setTimeout(() => {
                this.showAlert = false;
            }, this.remainingTime - this.elapsedTime);
        },
        closeAlert() {
            this.showAlert = false;
            clearTimeout(this.alertTimeout);
            this.elapsedTime = 0;
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
    <div class="container mt-5">
        <h2>Свяжитесь с нами</h2>
        <form @submit.prevent="handleSubmit">
            <div class="mb-3">
                <label for="name" class="form-label">Ваше имя</label>
                <input type="text" class="form-control" v-model="name" placeholder="Введите ваше имя" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" v-model="email" placeholder="Введите ваш email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Сообщение</label>
                <textarea class="form-control" v-model="message" rows="3" placeholder="Введите ваше сообщение"
                    required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>

        <div v-if="showAlert" class="alert alert-success alert-dismissible custom-alert" role="alert"
            @mouseover="pauseAlert" @mouseleave="resumeAlert">
            <strong>Успех!</strong> Ваше сообщение отправлено.
            <button type="button" class="btn-close" @click="closeAlert" aria-label="Close"></button>
        </div>
    </div>
</template>

<style scoped>
.custom-alert {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1050;
    width: 300px;
}
</style>