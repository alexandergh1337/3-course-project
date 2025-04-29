article<script>
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

    <section class="about-section">
        <article class="container mt-5">
            <article class="row">
                <article class="col-md-6">
                    <article class="about-image">
                        <img src="/src/assets/img/990.jpg" class="img-fluid rounded" alt="О нас">
                    </article>
                </article>
                <article class="col-md-6">
                    <article class="about-text">
                        <h1>О нас</h1>
                        <p>Добро пожаловать в наш магазин электроники и техники! Мы предлагаем широкий ассортимент
                            товаров от ведущих производителей. Наша цель - предоставить вам лучшие продукты по доступным
                            ценам.</p>
                        <p>Мы гордимся качеством нашего обслуживания и стремимся сделать ваш опыт покупок максимально
                            удобным и приятным. Наша команда всегда готова помочь вам с выбором и ответить на все ваши
                            вопросы.</p>
                        <p>Спасибо, что выбрали нас! Мы ценим ваше доверие и надеемся на долгосрочное сотрудничество.
                        </p>
                    </article>
                </article>
            </article>
        </article>
    </section>

    <Footer />
</template>


<style scoped>
.about-section {
    background-color: var(--about-bg);
    padding: 2rem;
    /* margin-bottom: 2rem; */
    border-bottom: 3rem solid transparent;
    /* border-radius: 8px; */
}

.about-text h1 {
    color: var(--about-heading);
    margin-bottom: 1.5rem;
}

.about-text p {
    color: var(--about-text);
    line-height: 1.6;
    margin-bottom: 1rem;
}

.about-image img {
    box-shadow: 0 4px 8px var(--about-image-shadow);
    /* transition: transform 0.3s ease; */
}

.about-image img:hover {
    transform: scale(1.02);
}

@media (max-width: 768px) {
    .about-image {
        margin-bottom: 2rem;
    }
}
</style>