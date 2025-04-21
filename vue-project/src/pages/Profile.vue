<script>
import Navbar from "../components/Navbar.vue";
import Footer from "../components/Footer.vue";
import { gsap } from "gsap";
import { getUser, logout } from '@/api/auth';

export default {
    name: 'Profile',
    components: {
        Navbar,
        Footer,
    },
    data() {
        return {
            tab: 'personal',
            personalName: '',
            personalEmail: '',
            personalPhone: '',
            favoriteProducts: [
                { id: 1, name: 'iPhone 15 Pro', category: 'Смартфоны', price: 120000, brand: 'Apple', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/e853c72719633e353b65193e301cc9e9/8517b5d57caefeef97194196729bd221e1606cafc9a005f423b21eb56314ba96.jpg.webp' },
                { id: 3, name: 'Sony WH-1000XM5', category: 'Наушники', price: 25000, brand: 'Sony', image: 'https://c.dns-shop.ru/thumb/st4/fit/500/500/92f5097a5043cd3526f7b4f492d02459/2df2632475190df8324dd72376786ed737facef7dc387bf5fcd76f88d5fc28ec.jpg.webp' },
                { id: 4, name: 'MacBook Air M2', category: 'Ноутбуки', price: 110000, brand: 'Apple', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/318259187cb6d5356730f526caa8ae93/f90f6266dac6bf12212723b31fa2a073677c5ca54cefbc551f8d896ae1a67af5.jpg.webp' },
                { id: 8, name: 'Sony PlayStation 5', category: 'Игровые консоли', price: 60000, brand: 'Sony', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/d4c2d22f316a43bae74155ee37140f1e/18a00d64a85957b578be630af5bd9d6b7a33198b8128abad151a1c2563095d6f.jpg.webp' },
                { id: 12, name: 'Xiaomi Redmi Note 13', category: 'Смартфоны', price: 25000, brand: 'Xiaomi', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/dd182dc1b0265b6b9c762a76553ecb91/c535077fe172ce14b87dc57b1c9a0d3873cf76bf608832dfa58f4f928759fe0c.jpg.webp' }
            ],
            favoritesPage: 1,
            favoritesPerPage: 3,
            showToast: false,
            toastMessage: '',
            toastTimeout: null,
            toastDuration: 3000,
            toastStartTime: null,
            toastElapsed: 0,
            orderHistory: [
                {
                    id: 1,
                    name: 'iPhone 15 Pro',
                    image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/e853c72719633e353b65193e301cc9e9/8517b5d57caefeef97194196729bd221e1606cafc9a005f423b21eb56314ba96.jpg.webp',
                    price: 120000,
                    quantity: 1
                },
                {
                    id: 2,
                    name: 'Sony WH-1000XM5',
                    image: 'https://c.dns-shop.ru/thumb/st4/fit/500/500/92f5097a5043cd3526f7b4f492d02459/2df2632475190df8324dd72376786ed737facef7dc387bf5fcd76f88d5fc28ec.jpg.webp',
                    price: 25000,
                    quantity: 2
                }
            ],
            ordersPage: 1,
            ordersPerPage: 5
        }
    },
    async mounted() {
        try {
            const user = await getUser();
            this.personalName = user.name;
            this.personalEmail = user.email;
            this.personalPhone = user.phone || '';
        } catch (e) {
            this.$router.push('/login');
        }
    },
    computed: {
        paginatedFavorites() {
            const start = (this.favoritesPage - 1) * this.favoritesPerPage;
            return this.favoriteProducts.slice(start, start + this.favoritesPerPage);
        },
        favoritesTotalPages() {
            return Math.ceil(this.favoriteProducts.length / this.favoritesPerPage);
        },
        paginatedOrders() {
            const start = (this.ordersPage - 1) * this.ordersPerPage;
            return this.orderHistory.slice(start, start + this.ordersPerPage);
        },
        ordersTotalPages() {
            return Math.ceil(this.orderHistory.length / this.ordersPerPage);
        }
    },
    methods: {
        changeFavoritesPage(page) {
            if (page >= 1 && page <= this.favoritesTotalPages) {
                this.favoritesPage = page;
            }
        },
        changeOrdersPage(page) {
            if (page >= 1 && page <= this.ordersTotalPages) {
                this.ordersPage = page;
            }
        },
        formatPrice(price) {
            return new Intl.NumberFormat('ru-RU').format(price);
        },
        removeFromFavorites(product) {
            this.favoriteProducts = this.favoriteProducts.filter(p => p.id !== product.id);
            this.showRemoveToast(product.name);
        },
        showRemoveToast(productName) {
            this.toastMessage = { productName, action: "удалён из избранного" };
            this.showToast = true;
            this.toastStartTime = Date.now();
            this.toastElapsed = 0;
            clearTimeout(this.toastTimeout);
            this.setToastTimeout();
            this.$nextTick(() => {
                gsap.fromTo(".custom-toast", { opacity: 0, y: 50 }, { opacity: 1, y: 0, duration: 0.5 });
            });
        },
        setToastTimeout() {
            this.toastTimeout = setTimeout(() => {
                this.closeToast();
            }, this.toastDuration - this.toastElapsed);
        },
        closeToast() {
            gsap.to(".custom-toast", {
                opacity: 0, y: 50, duration: 0.5, onComplete: () => {
                    this.showToast = false;
                    clearTimeout(this.toastTimeout);
                    this.toastElapsed = 0;
                }
            });
        },
        pauseToast() {
            clearTimeout(this.toastTimeout);
            this.toastElapsed = Date.now() - this.toastStartTime;
        },
        resumeToast() {
            this.setToastTimeout();
            this.toastStartTime = Date.now();
        },
        async handleLogout() {
            await logout();
            this.$router.push('/login');
        }
    }
}
</script>

<template>
    <Navbar />

    <section class="profile-section">
        <section class="profile-page container py-4">
            <h1 class="mb-4">Профиль</h1>
            <nav class="nav nav-tabs mb-4">
                <button class="nav-link" :class="{ active: tab === 'personal' }" @click="tab = 'personal'">Личные
                    данные</button>
                <button class="nav-link" :class="{ active: tab === 'orders' }" @click="tab = 'orders'">История
                    заказов</button>
                <button class="nav-link" :class="{ active: tab === 'favorites' }"
                    @click="tab = 'favorites'">Избранное</button>
            </nav>
            <section v-if="tab === 'personal'">
                <h2 class="mb-4">Личные данные</h2>
                <form class="personal-form row g-3 align-items-center" @submit.prevent>
                    <article class="col-md-5">
                        <label for="profileName" class="form-label">Имя</label>
                        <input type="text" class="form-control" id="profileName" v-model="personalName">
                    </article>
                    <article class="col-md-5">
                        <label farticleor="profileEmail" class="form-label">Почта</label>
                        <input type="email" class="form-control" id="profileEmail" v-model="personalEmail">
                    </article>
                    <article class="col-md-5">
                        <label for="profilePhone" class="form-label">Телефон</label>
                        <input type="tel" class="form-control" id="profilePhone" v-model="personalPhone">
                    </article>
                    <article class="col-md-2 d-flex align-items-end mt-5">
                        <button type="button" class="btn btn-outline-primary w-100">Изменить</button>
                    </article>
                </form>
                <button class="btn btn-danger mt-4" @click="handleLogout">Выйти</button>
            </section>
            <section v-else-if="tab === 'orders'">
                <h2 class="mb-4">История заказов</h2>
                <table style="border-collapse: collapse; width: 100%; border: 1px solid black;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid black; padding: 8px;">Название</th>
                            <th style="border: 1px solid black; padding: 8px; text-align: center;">Изображение</th>
                            <th style="border: 1px solid black; padding: 8px;">Цена</th>
                            <th style="border: 1px solid black; padding: 8px;">Количество</th>
                            <th style="border: 1px solid black; padding: 8px;">Сумма</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in paginatedOrders" :key="order.id">
                            <td style="border: 1px solid black; padding: 8px;">{{ order.name }}</td>
                            <td style="border: 1px solid black; padding: 8px; text-align: center">
                                <img :src="order.image" :alt="order.name"
                                    style="width: 60px; height: 60px; object-fit: contain; display: block; margin: 0 auto;" />
                            </td>
                            <td style="border: 1px solid black; padding: 8px;">{{ formatPrice(order.price) }} ₽</td>
                            <td style="border: 1px solid black; padding: 8px;">{{ order.quantity }}</td>
                            <td style="border: 1px solid black; padding: 8px;">{{ formatPrice(order.price *
                                order.quantity) }} ₽</td>
                        </tr>
                    </tbody>
                </table>
                <nav v-if="ordersTotalPages > 1" class="d-flex justify-content-center mt-3">
                    <ul class="pagination">
                        <li class="page-item" :class="{ disabled: ordersPage === 1 }">
                            <a class="page-link" href="#" @click.prevent="changeOrdersPage(ordersPage - 1)">&laquo;</a>
                        </li>
                        <li v-for="page in ordersTotalPages" :key="page" class="page-item"
                            :class="{ active: ordersPage === page }">
                            <a class="page-link" href="#" @click.prevent="changeOrdersPage(page)">{{ page }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: ordersPage === ordersTotalPages }">
                            <a class="page-link" href="#" @click.prevent="changeOrdersPage(ordersPage + 1)">&raquo;</a>
                        </li>
                    </ul>
                </nav>
            </section>
            <section v-else-if="tab === 'favorites'">
                <h2 class="mb-4">Избранное</h2>
                <article v-if="favoriteProducts.length === 0" class="text-center text-muted py-5">
                    <p>У вас нет избранных товаров.</p>
                </article>
                <article v-else>
                    <article class="row">
                        <article class="col-md-4 mb-4" v-for="product in paginatedFavorites" :key="product.id">
                            <article class="card product-card h-100">
                                <img :src="product.image" class="card-img-top" :alt="product.name">
                                <article class="card-body d-flex flex-column text-start">
                                    <article class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title product-title">{{ product.name }}</h5>
                                        <button class="btn btn-sm btn-icon" @click="removeFromFavorites(product)">
                                            <i class="bi bi-heart-fill heart-filled"></i>
                                        </button>
                                    </article>
                                    <p class="card-text product-category mb-1">{{ product.category }}</p>
                                    <p class="card-text product-brand mb-2"><small>Бренд: {{ product.brand }}</small>
                                    </p>
                                    <h6 class="product-price mt-auto">{{ formatPrice(product.price) }} ₽</h6>
                                </article>
                            </article>
                        </article>
                    </article>
                    <nav v-if="favoritesTotalPages > 1" class="d-flex justify-content-center mt-3">
                        <ul class="pagination">
                            <li class="page-item" :class="{ disabled: favoritesPage === 1 }">
                                <a class="page-link" href="#"
                                    @click.prevent="changeFavoritesPage(favoritesPage - 1)">&laquo;</a>
                            </li>
                            <li v-for="page in favoritesTotalPages" :key="page" class="page-item"
                                :class="{ active: favoritesPage === page }">
                                <a class="page-link" href="#" @click.prevent="changeFavoritesPage(page)">{{ page }}</a>
                            </li>
                            <li class="page-item" :class="{ disabled: favoritesPage === favoritesTotalPages }">
                                <a class="page-link" href="#"
                                    @click.prevent="changeFavoritesPage(favoritesPage + 1)">&raquo;</a>
                            </li>
                        </ul>
                    </nav>
                </article>
                <article v-if="showToast" class="custom-toast toast-favorite" @mouseover="pauseToast"
                    @mouseleave="resumeToast">
                    <article class="toast-body">
                        <span><strong>{{ toastMessage.productName }}</strong> {{ toastMessage.action }}</span>
                        <button type="button" class="btn-close ms-2" @click="closeToast" aria-label="Закрыть"></button>
                    </article>
                </article>
            </section>
        </section>
    </section>

    <Footer />
</template>


<style scoped>
.profile-section {
    background-color: var(--profile-bg);
    padding: 2rem 0;

}

.profile-page {
    max-width: 1000px;

}

h1 {
    color: var(--profile-title);
}

h2 {
    color: var(--profile-title);
}

.nav-tabs {
    border-bottom: 1px solid var(--profile-section-border);
}

.nav-link {
    color: var(--profile-section-text);
}

.nav-link.active {
    background-color: var(--profile-section-bg);
    color: var(--profile-title);
    border-color: var(--profile-section-border) var(--profile-section-border) var(--profile-section-bg);
}

.personal-form {
    background-color: var(--profile-section-bg);
    border: 1px solid var(--profile-section-border);
    border-radius: 8px;
    padding: 1.5rem 1rem;
    color: var(--profile-section-text);
}

.personal-form input {
    background-color: var(--input-bg);
    color: var(--input-text);
    border-color: var(--input-border);
}

.personal-form input:focus {
    background-color: var(--input-bg);
    color: var(--input-text);
    border-color: var(--input-focus-border);
    box-shadow: 0 0 0 0.2rem var(--input-focus-shadow);
}

.product-card {
    background-color: var(--card-bg);
    border-color: var(--card-border);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px var(--catalog-toast-shadow);
}

.card-img-top {
    height: 200px;
    object-fit: contain;
    padding: 1rem;
}

.card-body.text-start {
    text-align: left;
}

.product-title {
    color: var(--profile-title);
    font-size: 1.1rem;
    font-weight: 600;
    margin-right: 1.5rem;
}

.product-price {
    color: var(--profile-title);
    font-weight: 700;
}

.btn-icon {
    background: transparent;
    border: none;
    color: var(--profile-title);
    font-size: 1.25rem;
    padding: 0;
}

.heart-filled {
    color: var(--catalog-heart-filled);
}

.product-brand {
    color: var(--profile-section-text);
}

.product-category {
    color: var(--profile-section-text);
}

.custom-toast {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1050;
    width: 300px;
    border-radius: 5px;
    padding: 12px 16px;
    box-shadow: 0 4px 12px var(--catalog-toast-shadow);
    display: flex;
    align-items: center;
}

.toast-body {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.toast-favorite {
    background-color: var(--profile-toast-bg);
    color: var(--profile-toast-text);
    border: 1px solid var(--profile-toast-border);
}

.custom-toast .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}

.custom-toast .btn-close:hover {
    opacity: 1;
}

table {
    border-color: var(--profile-table-border) !important;
}

th {
    background-color: var(--profile-table-header);
    color: var(--profile-title);
    border-color: var(--profile-table-border) !important;
}

td {
    border-color: var(--profile-table-border) !important;
    color: var(--profile-table-text);
}

.pagination .page-link {
    color: var(--accent-color);
    background-color: var(--background-primary);
    border-color: var(--border-color);
}

.pagination .page-item.active .page-link {
    background-color: var(--catalog-pagination-active-bg);
    border-color: var(--catalog-pagination-active-bg);
    color: var(--catalog-pagination-active-text);
}

.pagination .page-item.disabled .page-link {
    color: var(--catalog-pagination-disabled);
    background-color: var(--background-primary);
    border-color: var(--border-color);
}
</style>