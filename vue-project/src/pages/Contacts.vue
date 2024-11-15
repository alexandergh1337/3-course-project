<script>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import { gsap } from 'gsap';

export default {
    name: 'Contacts',
    components: {
        Navbar,
        Footer
    },
    mounted() {
        gsap.from(".contacts-text", { duration: 0.9, opacity: 0, x: -100 });
        gsap.from(".contacts-image img", { duration: 0.9, opacity: 0, x: 100, delay: 0.3 });
    }
}
</script>

<template>
    <Navbar />

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="contacts-text">
                    <h1>Контакты</h1>
                    <p>Мы рады приветствовать вас в нашем магазине электроники и техники! Здесь вы найдете широкий ассортимент товаров, включая новейшие модели смартфонов, ноутбуков, телевизоров и бытовой техники.</p>
                    <p>Наш адрес: <a href="https://yandex.ru/maps/?ll=37.621587%2C55.753924&z=16&text=Москва%2C%20Красная%20площадь%2C%203"
                        target="_blank" class="text-dark">Москва, Красная площадь, 3, Россия</a>. Мы работаем ежедневно с 10:00 до 20:00. Вы можете связаться с нами по телефону <a href="tel:+71234567890" class="text-dark">+7 (123) 456-78-90</a> или отправить нам письмо на электронную почту <a href="mailto:support@electroshop.com" class="text-dark">support@electroshop.com</a>.</p>
                    <p>Мы предлагаем услуги доставки и установки техники. Наши специалисты помогут вам настроить и подключить вашу новую технику, чтобы вы могли сразу начать ею пользоваться.</p>
                    <p>Следите за нашими акциями и специальными предложениями на нашем сайте и в социальных сетях. Мы всегда рады видеть вас в нашем магазине и готовы помочь вам с выбором!</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contacts-image">
                    <img src="https://core-pht-proxy.maps.yandex.ru/v1/photos/download?photo_id=mds03QctvgOByGqTLvc&image_size=X5L" class="img-fluid rounded" alt="Контакты">
                </div>
            </div>
        </div>
    </div>

    <Footer />
</template>

<style scoped>
a {
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>