<script>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import { gsap } from "gsap";
import axios from 'axios';

export default {
    name: 'Catalog',
    components: {
        Navbar,
        Footer
    },
    data() {
        return {
            products: [],
            filteredProducts: [],
            categories: ['Все категории'],
            brands: ['Все бренды'],
            selectedCategory: 'Все категории',
            selectedBrand: 'Все бренды',
            minPrice: 0,
            maxPrice: 300000,
            priceRange: [0, 300000],
            searchQuery: '',
            currentPage: 1,
            itemsPerPage: 6,
            sortOption: 'default',
            showToast: false,
            toastMessage: '',
            toastType: 'cart',
            toastTimeout: null,
            remainingTime: 5000,
            startTime: null,
            elapsedTime: 0
        };
    },
    computed: {
        paginatedProducts() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            return this.filteredProducts.slice(startIndex, startIndex + this.itemsPerPage);
        },
        totalPages() {
            return Math.ceil(this.filteredProducts.length / this.itemsPerPage);
        },
        pages() {
            const pages = [];
            for (let i = 1; i <= this.totalPages; i++) {
                pages.push(i);
            }
            return pages;
        },
        toastClass() {
            return this.toastType === 'favorite' ? 'toast-favorite' : 'toast-cart';
        }
    },
    methods: {
        applyFilters() {
            let result = [...this.products];

            if (this.selectedCategory !== 'Все категории') {
                result = result.filter(p => p.category === this.selectedCategory);
            }

            if (this.selectedBrand !== 'Все бренды') {
                result = result.filter(p => p.brand === this.selectedBrand);
            }

            result = result.filter(p => p.price >= this.priceRange[0] && p.price <= this.priceRange[1]);

            if (this.searchQuery) {
                const query = this.searchQuery.toLowerCase();
                result = result.filter(p =>
                    p.name.toLowerCase().includes(query) ||
                    p.brand.toLowerCase().includes(query) ||
                    p.category.toLowerCase().includes(query)
                );
            }

            switch (this.sortOption) {
                case 'price-asc':
                    result.sort((a, b) => a.price - b.price);
                    break;
                case 'price-desc':
                    result.sort((a, b) => b.price - a.price);
                    break;
                case 'name-asc':
                    result.sort((a, b) => a.name.localeCompare(b.name));
                    break;
                case 'name-desc':
                    result.sort((a, b) => b.name.localeCompare(a.name));
                    break;
                default:
                    result.sort((a, b) => a.id - b.id);
                    break;
            }

            this.filteredProducts = result;
            this.currentPage = 1;
        },
        resetFilters() {
            this.selectedCategory = 'Все категории';
            this.selectedBrand = 'Все бренды';
            this.priceRange = [0, 300000];
            this.searchQuery = '';
            this.sortOption = 'default';
            this.applyFilters();
        },
        changePage(page) {
            this.currentPage = page;
            window.scrollTo(0, 0);
        },
        toggleFavorite(product) {
            const wasFavorite = product.isFavorite;
            product.isFavorite = !product.isFavorite;
            if (product.isFavorite) {
                function getCookie(name) {
                    const value = `; ${document.cookie}`;
                    const parts = value.split(`; ${name}=`);
                    if (parts.length === 2) return parts.pop().split(';').shift();
                }
                fetch('http://localhost:8000/sanctum/csrf-cookie', { credentials: 'include' })
                    .then(() => {
                        const xsrfToken = getCookie('XSRF-TOKEN');
                        return fetch('http://localhost:8000/api/favorites', {
                            method: 'POST',
                            credentials: 'include',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-XSRF-TOKEN': xsrfToken ? decodeURIComponent(xsrfToken) : ''
                            },
                            body: JSON.stringify({ product_id: product.id })
                        });
                    })
                    .then(response => {
                        if (!response.ok) {
                            product.isFavorite = wasFavorite;
                        } else {
                            this.showNotification(product.name, 'добавлен в избранное', 'favorite');
                        }
                    });
            } else {
                function getCookie(name) {
                    const value = `; ${document.cookie}`;
                    const parts = value.split(`; ${name}=`);
                    if (parts.length === 2) return parts.pop().split(';').shift();
                }
                fetch('http://localhost:8000/sanctum/csrf-cookie', { credentials: 'include' })
                    .then(() => {
                        const xsrfToken = getCookie('XSRF-TOKEN');
                        return fetch('http://localhost:8000/api/favorites', {
                            method: 'DELETE',
                            credentials: 'include',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-XSRF-TOKEN': xsrfToken ? decodeURIComponent(xsrfToken) : ''
                            },
                            body: JSON.stringify({ product_id: product.id })
                        });
                    })
                    .then(response => {
                        if (!response.ok) {
                            product.isFavorite = wasFavorite;
                        } else {
                            this.showNotification(product.name, 'удален из избранного', 'favorite');
                        }
                    });
            }
        },
        addToCart(product) {
            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
            }
            fetch('http://localhost:8000/sanctum/csrf-cookie', { credentials: 'include' })
                .then(() => {
                    const xsrfToken = getCookie('XSRF-TOKEN');
                    return fetch('http://localhost:8000/api/cart', {
                        method: 'POST',
                        credentials: 'include',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-XSRF-TOKEN': xsrfToken ? decodeURIComponent(xsrfToken) : ''
                        },
                        body: JSON.stringify({ product_id: product.id, quantity: 1 })
                    });
                })
                .then(response => {
                    if (response.ok) {
                        this.showNotification(product.name, 'добавлен в корзину', 'cart');
                    } else if (response.status === 401) {
                        this.showNotification(product.name, 'требуется вход', 'cart');
                    } else {
                        this.showNotification(product.name, 'ошибка добавления', 'cart');
                    }
                })
                .catch(() => {
                    this.showNotification(product.name, 'ошибка добавления', 'cart');
                });
        },
        showNotification(productName, action, type) {
            if (this.showToast) {
                this.closeToast();
                setTimeout(() => {
                    this.displayNewToast(productName, action, type);
                }, 300);
            } else {
                this.displayNewToast(productName, action, type);
            }
        },
        displayNewToast(productName, action, type) {
            this.toastMessage = { productName, action };
            this.toastType = type;
            this.showToast = true;
            this.startTime = Date.now();
            this.elapsedTime = 0;
            this.setToastTimeout();

            this.$nextTick(() => {
                gsap.fromTo(".custom-toast", { opacity: 0, y: 50 }, { opacity: 1, y: 0, duration: 0.5 });
            });
        },
        setToastTimeout() {
            this.toastTimeout = setTimeout(() => {
                this.closeToast();
            }, this.remainingTime - this.elapsedTime);
        },
        closeToast() {
            gsap.to(".custom-toast", {
                opacity: 0, y: 50, duration: 0.5, onComplete: () => {
                    this.showToast = false;
                    clearTimeout(this.toastTimeout);
                    this.elapsedTime = 0;
                }
            });
        },
        pauseToast() {
            clearTimeout(this.toastTimeout);
            this.elapsedTime = Date.now() - this.startTime;
        },
        resumeToast() {
            this.setToastTimeout();
            this.startTime = Date.now();
        },
        formatPrice(price) {
            return new Intl.NumberFormat('ru-RU').format(price);
        }
    },
    mounted() {
        axios.get('http://localhost:8000/api/products')
            .then(response => {
                this.products = response.data.map(p => ({ ...p, isFavorite: false }));
                const categoriesSet = new Set();
                const brandsSet = new Set();
                this.products.forEach(p => {
                    if (p.category) categoriesSet.add(p.category);
                    if (p.brand) brandsSet.add(p.brand);
                });
                this.categories = ['Все категории', ...Array.from(categoriesSet)];
                this.brands = ['Все бренды', ...Array.from(brandsSet)];
                this.filteredProducts = [...this.products];
                return axios.get('http://localhost:8000/api/favorites', { withCredentials: true });
            })
            .then(response => {
                if (response.data) {
                    const favoriteIds = response.data.map(f => f.product_id);
                    this.products.forEach(p => {
                        p.isFavorite = favoriteIds.includes(p.id);
                    });
                    this.filteredProducts = [...this.products];
                }
            })
            .catch(() => {
                this.products = [];
                this.filteredProducts = [];
            });
    }
};
</script>

<template>
    <Navbar />

    <section class="catalog-section">
        <article class="container catalog-container">
            <h1 class="mb-4 catalog-title">Каталог товаров</h1>

            <article class="row mb-4">
                <article class="col-md-6 mb-3 mb-md-0">
                    <article class="input-group">
                        <input type="text" class="form-control" v-model="searchQuery"
                            placeholder="Поиск по названию, бренду..." @keyup.enter="applyFilters">
                        <button class="btn btn-outline-primary" type="button" @click="applyFilters">
                            <i class="bi bi-search"></i>
                        </button>
                    </article>
                </article>
                <article class="col-md-6 d-flex justify-content-md-end">
                    <select class="form-select sort-select" v-model="sortOption" @change="applyFilters">
                        <option value="default">По умолчанию</option>
                        <option value="price-asc">По цене (возрастание)</option>
                        <option value="price-desc">По цене (убывание)</option>
                        <option value="name-asc">По названию (А-Я)</option>
                        <option value="name-desc">По названию (Я-А)</option>
                    </select>
                </article>
            </article>

            <article class="row">
                <article class="col-lg-3 mb-4">
                    <article class="card filter-card">
                        <article class="card-body">
                            <h5 class="card-title filter-title">Фильтры</h5>

                            <article class="mb-3">
                                <label class="form-label">Категория</label>
                                <select class="form-select" v-model="selectedCategory">
                                    <option v-for="category in categories" :key="category">{{ category }}</option>
                                </select>
                            </article>

                            <article class="mb-3">
                                <label class="form-label">Бренд</label>
                                <select class="form-select" v-model="selectedBrand">
                                    <option v-for="brand in brands" :key="brand">{{ brand }}</option>
                                </select>
                            </article>

                            <article class="mb-3">
                                <label class="form-label">Цена</label>
                                <article class="d-flex justify-content-between mb-2">
                                    <span class="price-range-value">{{ formatPrice(priceRange[0]) }} ₽</span>
                                    <span class="price-range-value">{{ formatPrice(priceRange[1]) }} ₽</span>
                                </article>
                                <input type="range" class="form-range" min="0" max="300000" step="5000"
                                    v-model.number="priceRange[0]">
                                <input type="range" class="form-range" min="0" max="300000" step="5000"
                                    v-model.number="priceRange[1]">
                            </article>

                            <article class="d-grid gap-2">
                                <button class="btn btn-success" @click="applyFilters">Применить</button>
                                <button class="btn btn-outline-secondary" @click="resetFilters">Сбросить</button>
                            </article>
                        </article>
                    </article>
                </article>

                <article class="col-lg-9">
                    <article class="mb-3">
                        <span class="catalog-results-count">Найдено товаров: {{ filteredProducts.length }}</span>
                    </article>

                    <article v-if="filteredProducts.length === 0" class="catalog-no-results text-center p-5">
                        <h3>Товары не найдены</h3>
                        <p>Попробуйте изменить параметры фильтрации</p>
                    </article>

                    <article class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                        <article class="col" v-for="product in paginatedProducts" :key="product.id">
                            <article class="card product-card h-100">
                                <img :src="product.image" class="card-img-top" :alt="product.name">
                                <article class="card-body d-flex flex-column">
                                    <article class="d-flex justify-content-between align-items-start">
                                        <h5 class="card-title product-title">{{ product.name }}</h5>
                                        <button class="btn btn-sm btn-icon" @click="toggleFavorite(product)">
                                            <i class="bi"
                                                :class="product.isFavorite ? 'bi-heart-fill heart-filled' : 'bi-heart'"></i>
                                        </button>
                                    </article>
                                    <p class="card-text product-category mb-1">{{ product.category }}</p>
                                    <p class="card-text product-brand mb-2"><small>Бренд: {{ product.brand }}</small>
                                    </p>
                                    <h5 class="product-price mt-auto">{{ formatPrice(product.price) }} ₽</h5>
                                    <button class="btn btn-primary mt-3" @click="addToCart(product)">
                                        <i class="bi bi-cart-plus"></i> В корзину
                                    </button>
                                </article>
                            </article>
                        </article>
                    </article>

                    <article class="d-flex justify-content-center mt-5" v-if="totalPages > 1">
                        <nav aria-label="Навигация по страницам">
                            <ul class="pagination">
                                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                    <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)"
                                        aria-label="Предыдущая">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li v-for="page in pages" :key="page" class="page-item"
                                    :class="{ active: currentPage === page }">
                                    <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
                                </li>
                                <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                                    <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)"
                                        aria-label="Следующая">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </article>
                </article>
            </article>
        </article>
    </section>

    <article v-if="showToast" class="custom-toast" :class="toastClass" @mouseover="pauseToast"
        @mouseleave="resumeToast">
        <article class="toast-body">
            <article>
                <strong>{{ toastMessage.productName }}</strong> {{ toastMessage.action }}
            </article>
            <button type="button" class="btn-close ms-2" @click="closeToast" aria-label="Закрыть"></button>
        </article>
    </article>

    <Footer />
</template>

<style scoped>
.catalog-section {
    background-color: var(--catalog-bg);
    padding: 2rem 0;
    min-height: calc(100vh - 200px);
}

.catalog-container {
    margin-top: 1rem;
    margin-bottom: 3rem;
}

.catalog-title {
    color: var(--catalog-title);
}

.filter-card {
    background-color: var(--catalog-filter-bg);
    border-color: var(--catalog-filter-border);
}

.filter-title {
    color: var(--catalog-filter-title);
    font-weight: 600;
}

.form-label {
    color: var(--form-label);
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

.product-card .card-img-top {
    height: 200px;
    object-fit: contain;
    padding: 1rem;
}

.product-title {
    color: var(--catalog-title);
    font-size: 1.1rem;
    font-weight: 600;
    margin-right: 1.5rem;
}

.product-price {
    color: var(--catalog-title);
    font-weight: 700;
}

.btn-icon {
    background: transparent;
    border: none;
    color: var(--catalog-heart-empty);
    font-size: 1.25rem;
    padding: 0;
}

.heart-filled {
    color: var(--catalog-heart-filled);
}

.sort-select {
    min-width: 200px;
    background-color: var(--input-bg);
    color: var(--input-text);
    border-color: var(--input-border);
}

.form-select,
.form-range,
.form-control {
    background-color: var(--input-bg);
    color: var(--input-text);
    border-color: var(--input-border);
}

.form-select:focus,
.form-control:focus {
    background-color: var(--input-bg);
    color: var(--input-text);
    border-color: var(--input-focus-border);
    box-shadow: 0 0 0 0.2rem var(--input-focus-shadow);
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

.toast-cart {
    background-color: var(--catalog-toast-cart-bg);
    color: var(--catalog-toast-text);
    border: 1px solid var(--catalog-toast-cart-border);
}

.toast-favorite {
    background-color: var(--catalog-toast-favorite-bg);
    color: var(--catalog-toast-text);
    border: 1px solid var(--catalog-toast-favorite-border);
}

.custom-toast .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}

.custom-toast .btn-close:hover {
    opacity: 1;
}

.catalog-results-count {
    color: var(--catalog-results-text);
}

.price-range-value {
    color: var(--catalog-results-text);
}

.form-control::placeholder {
    color: var(--input-placeholder);
    opacity: 0.7;
}

.product-brand {
    color: var(--catalog-brand-text);
}

.product-category {
    color: var(--catalog-results-text);
}

.catalog-no-results {
    color: var(--catalog-title);
}
</style>