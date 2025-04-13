<script>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';
import { gsap } from "gsap";

export default {
    name: 'Catalog',
    components: {
        Navbar,
        Footer
    },
    data() {
        return {
            products: [
                { id: 1, name: 'iPhone 15 Pro', category: 'Смартфоны', price: 120000, brand: 'Apple', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/e853c72719633e353b65193e301cc9e9/8517b5d57caefeef97194196729bd221e1606cafc9a005f423b21eb56314ba96.jpg.webp', isFavorite: false },
                { id: 2, name: 'Samsung Galaxy S24', category: 'Смартфоны', price: 95000, brand: 'Samsung', image: 'https://c.dns-shop.ru/thumb/st4/fit/500/500/eaeba33a42d4467c49de57f334bd36a7/666e7887f02c3b8fab3972c5e3cdf21561ec814af9a9276dc5f1b2a2163b69bf.jpg.webp', isFavorite: false },
                { id: 3, name: 'Sony WH-1000XM5', category: 'Наушники', price: 25000, brand: 'Sony', image: 'https://c.dns-shop.ru/thumb/st4/fit/500/500/92f5097a5043cd3526f7b4f492d02459/2df2632475190df8324dd72376786ed737facef7dc387bf5fcd76f88d5fc28ec.jpg.webp', isFavorite: false },
                { id: 4, name: 'MacBook Air M2', category: 'Ноутбуки', price: 110000, brand: 'Apple', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/318259187cb6d5356730f526caa8ae93/f90f6266dac6bf12212723b31fa2a073677c5ca54cefbc551f8d896ae1a67af5.jpg.webp', isFavorite: false },
                { id: 5, name: 'Apple Watch Series 9', category: 'Часы', price: 40000, brand: 'Apple', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/523dcc5680975cb8595118649c0ab4a8/d2e0a66b3fd2f505fa9a08426a170f381706d1046622d3deea4023da1f62a9df.jpg.webp', isFavorite: false },
                { id: 6, name: 'LG OLED55C1', category: 'Телевизоры', price: 90000, brand: 'LG', image: 'https://c.dns-shop.ru/thumb/st4/fit/500/500/15a8751d34c63702d27cc555514dd872/8f587353f780a0e16074c87a2a74c8e2088f544857aee31eb69e4b5c4ca14868.jpg.webp', isFavorite: false },
                { id: 7, name: 'Samsung Galaxy Tab S9', category: 'Планшеты', price: 60000, brand: 'Samsung', image: 'https://c.dns-shop.ru/thumb/st4/fit/500/500/a5ed967fc7a9239d62fbd1fc2bdb1472/84b554da4de5b2a9ad8e243c4078034878fc077fc1f4fc9040d16762c143a84e.jpg.webp', isFavorite: false },
                { id: 8, name: 'Sony PlayStation 5', category: 'Игровые консоли', price: 60000, brand: 'Sony', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/d4c2d22f316a43bae74155ee37140f1e/18a00d64a85957b578be630af5bd9d6b7a33198b8128abad151a1c2563095d6f.jpg.webp', isFavorite: false },
                { id: 9, name: 'Dyson V15', category: 'Бытовая техника', price: 45000, brand: 'Dyson', image: 'https://img.mvideo.ru/Big/20084585bb.jpg', isFavorite: false },
                { id: 10, name: 'Canon EOS R5', category: 'Фотоаппараты', price: 280000, brand: 'Canon', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/90307ec969b2809ac95376dd4280eed5/981403988ed9242c9650e34cf21f2153d22ee6150e5445826916d21cad711406.jpg.webp', isFavorite: false },
                { id: 11, name: 'iPad Air', category: 'Планшеты', price: 65000, brand: 'Apple', image: 'https://c.dns-shop.ru/thumb/st4/fit/500/500/386b0b6edd91ef383b20469483953975/dd2c3fcc0ef29bdbc8312d93258df0dbbc5ee30ec3483ee4e8b3772a22e22342.jpg.webp', isFavorite: false },
                { id: 12, name: 'Xiaomi Redmi Note 13', category: 'Смартфоны', price: 25000, brand: 'Xiaomi', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/dd182dc1b0265b6b9c762a76553ecb91/c535077fe172ce14b87dc57b1c9a0d3873cf76bf608832dfa58f4f928759fe0c.jpg.webp', isFavorite: false }
            ],
            filteredProducts: [],
            categories: ['Все категории', 'Смартфоны', 'Наушники', 'Ноутбуки', 'Часы', 'Телевизоры', 'Планшеты', 'Игровые консоли', 'Бытовая техника', 'Фотоаппараты'],
            brands: ['Все бренды', 'Apple', 'Samsung', 'Sony', 'LG', 'Xiaomi', 'Dyson', 'Canon'],
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
            product.isFavorite = !product.isFavorite;
            const action = product.isFavorite ? 'добавлен в избранное' : 'удален из избранного';
            this.showNotification(product.name, action, 'favorite');
        },
        addToCart(product) {
            this.showNotification(product.name, 'добавлен в корзину', 'cart');
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
        this.filteredProducts = [...this.products];
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
                        <input type="text" class="form-control" v-model="searchQuery" placeholder="Поиск по названию, бренду...">
                        <button class="btn btn-primary" type="button" @click="applyFilters">Найти</button>
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
                                <input type="range" class="form-range" min="0" max="300000" step="5000" v-model.number="priceRange[0]">
                                <input type="range" class="form-range" min="0" max="300000" step="5000" v-model.number="priceRange[1]">
                            </article>
                            
                            <article class="d-grid gap-2">
                                <button class="btn btn-primary" @click="applyFilters">Применить</button>
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
                                            <i class="bi" :class="product.isFavorite ? 'bi-heart-fill heart-filled' : 'bi-heart'"></i>
                                        </button>
                                    </article>
                                    <p class="card-text product-category mb-1">{{ product.category }}</p>
                                    <p class="card-text product-brand mb-2"><small>Бренд: {{ product.brand }}</small></p>
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
                                    <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)" aria-label="Предыдущая">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li v-for="page in pages" :key="page" class="page-item" :class="{ active: currentPage === page }">
                                    <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
                                </li>
                                <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                                    <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)" aria-label="Следующая">
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

    <article v-if="showToast" class="custom-toast" :class="toastClass" 
        @mouseover="pauseToast" @mouseleave="resumeToast">
        <article class="toast-body">
            <div>
                <strong>{{ toastMessage.productName }}</strong> {{ toastMessage.action }}
            </div>
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

.form-select, .form-range, .form-control {
    background-color: var(--input-bg);
    color: var(--input-text);
    border-color: var(--input-border);
}

.form-select:focus, .form-control:focus {
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