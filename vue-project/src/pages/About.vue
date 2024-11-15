<script>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import { gsap } from 'gsap';

export default {
    name: 'About',
    components: {
        Navbar,
        Footer
    },
    mounted() {
        gsap.from(".about-image img", { duration: 0.9, opacity: 0, x: -100 });
        gsap.from(".about-text", { duration: 0.9, opacity: 0, x: 100, delay: 0.3 });
    }
}
</script>

<template>
    <Navbar />

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="about-image">
                    <img src="/src/assets/img/990.jpg" class="img-fluid rounded" alt="О нас">
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-text">
                    <h1>О нас</h1>
                    <p>Добро пожаловать в наш магазин электроники и техники! Мы предлагаем широкий ассортимент товаров от ведущих производителей. Наша цель - предоставить вам лучшие продукты по доступным ценам.</p>
                    <p>Мы гордимся качеством нашего обслуживания и стремимся сделать ваш опыт покупок максимально удобным и приятным. Наша команда всегда готова помочь вам с выбором и ответить на все ваши вопросы.</p>
                    <p>Спасибо, что выбрали нас! Мы ценим ваше доверие и надеемся на долгосрочное сотрудничество.</p>
                </div>
            </div>
        </div>
    </div>

    <Footer />
</template>


<style scoped>

</style>