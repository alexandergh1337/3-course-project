<script>
export default {
    name: "Navbar",
};
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <router-link class="navbar-brand d-flex align-items-center" to="/">
                <img class="logo"
                    src="https://cdn-icons-png.freepik.com/256/6572/6572765.png?ga=GA1.1.311673308.1729616116&semt=ais_hybrid"
                    alt="light">
                <span class="brand-name ms-2">ElectroShop</span>
            </router-link>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">Главная</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/catalog">Каталог</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/about">О нас</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/contacts">Контакты</router-link>
                    </li>
                </ul>
                <ul class="navbar-nav ms-3 social-icons">
                    <li class="nav-item">
                        <a href="https://t.me" class="text-dark" aria-label="Telegram">
                            <img class="social-icon"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Telegram_2019_Logo.svg/512px-Telegram_2019_Logo.svg.png"
                                alt="Telegram">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://vk.com" class="text-dark" aria-label="ВКонтакте">
                            <img class="social-icon"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/archive/2/21/20220814010126%21VK.com-logo.svg/120px-VK.com-logo.svg.png"
                                alt="ВКонтакте">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://dzen.ru" class="text-dark" aria-label="Яндекс Дзен">
                            <img class="social-icon"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Yandex_Zen_logo_icon.svg/512px-Yandex_Zen_logo_icon.svg.png"
                                alt="Яндекс Дзен">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>
.logo {
    width: 32px;
    height: 32px;
}

.brand-name {
    font-size: 1.25rem;
    font-weight: bold;
}

.navbar-nav img {
    margin-left: 8px;
}

.social-icons {
    display: flex;
    flex-direction: row;
}

.social-icon {
    width: 32px;
    height: 32px;
}

@media (max-width: 768px) {
    .social-icons {
        justify-content: space-around;
        margin-top: 10px;
    }

    .social-icon {
        width: 40px;
        height: 40px;
    }
}

.router-link-active {
    font-weight: 700;
    color: #303133;
}
</style>
