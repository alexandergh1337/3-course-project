<script>
export default {
    name: "Navbar",
    data() {
        return {
            isDarkTheme: localStorage.getItem('theme') === 'dark'
        };
    },
    methods: {
        toggleTheme() {
            this.isDarkTheme = !this.isDarkTheme;
            const theme = this.isDarkTheme ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
        }
    },
    mounted() {
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', theme);
    }
};
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <article class="container-fluid">
            <router-link class="navbar-brand d-flex align-items-center" to="/">
                <!-- <img class="logo"
                    src="https://cdn-icons-png.freepik.com/256/6572/6572765.png?ga=GA1.1.311673308.1729616116&semt=ais_hybrid"
                    alt="light"> -->
                <img class="logo"
                    src="/src/assets/svg/logo.svg"
                    alt="light">
                <span class="brand-name ms-2"><strong>Electro</strong>Shop</span>
            </router-link>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <article class="collapse navbar-collapse" id="navbarNav">
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Дополнительно
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><router-link class="dropdown-item" to="/terms">Пользовательское соглашение</router-link>
                            </li>
                            <li><router-link class="dropdown-item" to="/privacy">Политика
                                    конфиденциальности</router-link></li>
                        </ul>
                    </li>
                </ul>
                <li class="nav-item list-unstyled ms-3 d-flex align-items-center profile">
                    <router-link to="/profile" class="nav-link" aria-label="Профиль">
                        <i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
                    </router-link>
                </li>
                <a @click="toggleTheme" class="ms-3 theme-toggle d-flex align-items-center">
                    <i :class="isDarkTheme ? 'bi bi-sun' : 'bi bi-moon'"></i>
                </a>
                <li class="nav-item list-unstyled ms-3 d-flex align-items-center profile">
                    <router-link to="/cart" class="nav-link" aria-label="Корзина">
                        <i class="bi bi-cart-fill" style="font-size: 1.5rem;"></i>
                    </router-link>
                </li>
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
            </article>
        </article>
    </nav>
</template>

<style scoped>
.navbar {
    border-bottom: 1px solid var(--navbar-border);
}

.logo {
    width: 32px;
    height: 32px;
}

.brand-name {
    font-size: 1.25rem;
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
    transition: transform 0.3s ease;
}

.social-icon:hover {
    transform: scale(1.1);
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

.nav-item .router-link-active  {
    font-weight: 700;
    color: #303133;
}

.theme-toggle {
    color: #0f0f0f;
    cursor: pointer;
    font-size: 1.5rem;
}

.theme-toggle i {
    margin-top: -8px;
}

.profile {
    margin-top: -8px;
}
</style>
