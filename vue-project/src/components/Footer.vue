<script>
export default {
    name: 'Footer'
};
</script>

<template>
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-uppercase">О нас</h5>
                    <p>ElectroShop — это ваш надежный партнер в области электроники и техники. Мы предлагаем
                        качественные товары по доступным ценам.</p>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-uppercase">Контакты</h5>
                    <ul class="list-unstyled">
                        <li>
                            <i class="bi bi-geo-alt"></i> Адрес:
                            <a href="https://yandex.ru/maps/?ll=37.621587%2C55.753924&z=16&text=Москва%2C%20Красная%20площадь%2C%203"
                                target="_blank" class="text-dark"> Москва, Красная площадь, 3</a>
                        </li>
                        <li>
                            <i class="bi bi-phone" style="margin-right: 3px;"></i>
                            <span>Телефон: </span>
                            <a href="tel:+71234567890" class="text-dark">+7 (123) 456-7890</a>
                        </li>
                        <li>
                            <i class="bi bi-envelope" style="margin-right: 5px;"></i>
                            <span>Email: </span>
                            <a href="mailto:support@electroshop.com" class="text-dark">support@electroshop.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 mb-4">
                    <h5 class="text-uppercase">Навигация</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <router-link to="/" class="text-dark">Главная</router-link>
                        </li>
                        <li>
                            <router-link to="/about" class="text-dark">О нас</router-link>
                        </li>
                        <li>
                            <router-link to="/catalog" class="text-dark">Каталог</router-link>
                        </li>
                        <li>
                            <router-link to="/contacts" class="text-dark">Контакты</router-link>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 mb-4">
                    <h5 class="txt-soc text-uppercase">Мы в соцсетях</h5>
                    <ul class="list-unstyled d-flex">
                        <li class="me-3">
                            <a href="https://t.me" class="text-dark" aria-label="Telegram">
                                <img style="width: 48px; height: 48px;"
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Telegram_2019_Logo.svg/512px-Telegram_2019_Logo.svg.png"
                                    alt="Telegram">
                            </a>
                        </li>
                        <li class="me-3">
                            <a href="https://vk.com" class="text-dark" aria-label="ВКонтакте">
                                <img style="width: 48px; height: 48px;"
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/archive/2/21/20220814010126%21VK.com-logo.svg/120px-VK.com-logo.svg.png"
                                    alt="ВКонтакте">
                            </a>
                        </li>
                        <li>
                            <a href="https://dzen.ru" class="text-dark" aria-label="Яндекс Дзен">
                                <img style="width: 48px; height: 48px;"
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Yandex_Zen_logo_icon.svg/512px-Yandex_Zen_logo_icon.svg.png"
                                    alt="Яндекс Дзен">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-center p-3">
            <p>&copy; 2024 ElectroShop. Все права защищены.</p>
        </div>
    </footer>
</template>

<style scoped>
footer {
    position: relative;
    width: 100%;
    bottom: 0;
    padding: 20px 0;
}

a {
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

.txt-soc {
    text-align: center;
}

ul.list-unstyled {
    margin: 0;
    padding: 0;
}

ul.list-unstyled li {
    list-style: none;
}

ul.list-unstyled.d-flex li {
    display: inline-block;
}

ul.list-unstyled.d-flex li.me-3 {
    margin-right: 20px;
}

ul.list-unstyled li img {
    width: 48px;
    height: 48px;
}

ul.d-flex {
    justify-content: center;
}

@media (min-width: 768px) {
    ul.d-flex {
        justify-content: center;
    }
}
</style>
