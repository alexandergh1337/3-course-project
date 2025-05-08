<script>
import Navbar from "../components/Navbar.vue";
import Footer from "../components/Footer.vue";
import axios from 'axios';

export default {
    name: 'Cart',
    components: {
        Navbar,
        Footer,
    },
    data() {
        return {
            cart: [],
            cartPage: 1,
            cartPerPage: 3,

        };
    },
    computed: {
        paginatedCart() {
            const start = (this.cartPage - 1) * this.cartPerPage;
            return this.cart.slice(start, start + this.cartPerPage);
        },
        cartTotalPages() {
            return Math.ceil(this.cart.length / this.cartPerPage);
        },
        totalSum() {
            return this.cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
        }
    },
    methods: {
        changeCartPage(page) {
            if (page >= 1 && page <= this.cartTotalPages) {
                this.cartPage = page;
            }
        },
        formatPrice(price) {
            return new Intl.NumberFormat('ru-RU').format(price);
        },
        updateQuantity(item, event) {
            let value = parseInt(event.target.value);
            if (isNaN(value) || value < 1) value = 1;
            item.quantity = value;
            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
            }
            fetch('http://localhost:8000/sanctum/csrf-cookie', { credentials: 'include' })
                .then(() => {
                    const xsrfToken = getCookie('XSRF-TOKEN');
                    return fetch('http://localhost:8000/api/cart', {
                        method: 'PATCH',
                        credentials: 'include',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-XSRF-TOKEN': xsrfToken ? decodeURIComponent(xsrfToken) : ''
                        },
                        body: JSON.stringify({ product_id: item.id, quantity: item.quantity })
                    });
                })
                .then(response => response.json())
                .then(data => {
                    if (data && data.items) {
                        this.cart = data.items.map(i => ({
                            id: i.product.id,
                            name: i.product.name,
                            image: i.product.image,
                            price: i.product.price,
                            quantity: i.quantity
                        }));
                    }
                });
        },
        removeItem(item) {
            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
            }
            fetch('http://localhost:8000/sanctum/csrf-cookie', { credentials: 'include' })
                .then(() => {
                    const xsrfToken = getCookie('XSRF-TOKEN');
                    return fetch('http://localhost:8000/api/cart', {
                        method: 'DELETE',
                        credentials: 'include',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-XSRF-TOKEN': xsrfToken ? decodeURIComponent(xsrfToken) : ''
                        },
                        body: JSON.stringify({ product_id: item.id })
                    });
                })
                .then(response => response.json())
                .then(data => {
                    if (data && data.items) {
                        this.cart = data.items.map(i => ({
                            id: i.product.id,
                            name: i.product.name,
                            image: i.product.image,
                            price: i.product.price,
                            quantity: i.quantity
                        }));
                    }
                    if (this.cartPage > this.cartTotalPages) {
                        this.cartPage = this.cartTotalPages || 1;
                    }
                });
        },
        checkout() {
            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
            }
            fetch('http://localhost:8000/sanctum/csrf-cookie', { credentials: 'include' })
                .then(() => {
                    const xsrfToken = getCookie('XSRF-TOKEN');
                    return fetch('http://localhost:8000/api/cart/checkout', {
                        method: 'POST',
                        credentials: 'include',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-XSRF-TOKEN': xsrfToken ? decodeURIComponent(xsrfToken) : ''
                        }
                    });
                })
                .then(response => response.json())
                .then(() => {
                    this.cart = [];
                    this.$router.push({ path: '/profile', query: { tab: 'orders' } });
                });
        },
    },
    mounted() {
        axios.get('http://localhost:8000/api/cart', { withCredentials: true })
            .then(response => {
                if (response.data && response.data.items) {
                    this.cart = response.data.items.map(item => ({
                        id: item.product.id,
                        name: item.product.name,
                        image: item.product.image,
                        price: item.product.price,
                        quantity: item.quantity
                    }));
                } else {
                    this.cart = [];
                }
            })
            .catch(() => {
                this.cart = [];
            });
    }
};
</script>

<template>
    <Navbar />
    <section class="cart-section">
        <section class="cart-page container py-4">
            <h1 class="mb-4">Корзина</h1>
            <article v-if="cart.length === 0" class="text-center text-muted py-5 fs-4">
                Ваша корзина пуста
            </article>
            <template v-else>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Название</th>
                            <th>Изображение</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Сумма</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in paginatedCart" :key="item.id">
                            <td>{{ item.name }}</td>
                            <td>
                                <img :src="item.image" :alt="item.name"
                                    style="width: 60px; height: 60px; object-fit: contain; display: block; margin: 0 auto;" class="text-center"/>
                            </td>
                            <td>{{ formatPrice(item.price) }} ₽</td>
                            <td>
                                <input type="number" min="1" v-model.number="item.quantity"
                                    @input="updateQuantity(item, $event)" style="width: 70px; text-align: center;" />
                            </td>
                            <td>{{ formatPrice(item.price * item.quantity) }} ₽</td>
                            <td style="text-align: center;">
                                <button class="btn btn-outline-danger" @click="removeItem(item)">
                                    <i class="bi bi-trash d-flex align-items-center"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <article class="cart-bottom d-flex justify-content-between align-items-center mt-4 flex-wrap">
                    <article class="cart-total text-start">
                        <span class="fw-bold">Общая сумма: </span>
                        <span class="fs-5">{{ formatPrice(totalSum) }} ₽</span>
                    </article>
                    <article class="cart-actions d-flex gap-2 mt-3 mt-md-0">
                        <router-link to="/catalog" class="btn btn-primary">Продолжить покупки</router-link>
                        <button class="btn btn-warning" @click="checkout">Оформить заказ</button>
                    </article>
                </article>
                <nav v-if="cartTotalPages > 1" class="d-flex justify-content-center mt-4">
                    <ul class="pagination">
                        <li class="page-item" :class="{ disabled: cartPage === 1 }">
                            <a class="page-link" href="#" @click.prevent="changeCartPage(cartPage - 1)">&laquo;</a>
                        </li>
                        <li v-for="page in cartTotalPages" :key="page" class="page-item"
                            :class="{ active: cartPage === page }">
                            <a class="page-link" href="#" @click.prevent="changeCartPage(page)">{{ page }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: cartPage === cartTotalPages }">
                            <a class="page-link" href="#" @click.prevent="changeCartPage(cartPage + 1)">&raquo;</a>
                        </li>
                    </ul>
                </nav>
            </template>
        </section>
    </section>
    <Footer />
</template>


<style scoped>
/* .cart-page {
    max-width: 1000px;
} */

h1 {
    color: var(--cart-title);
}

.cart-section {
    background-color: var(--cart-bg);
    padding: 3.25rem 0;

}

.cart-table {
    border-collapse: collapse;
    width: 100%;
    border: 1px solid var(--cart-table-border);
    background-color: var(--cart-bg);
}

.cart-table th,
.cart-table td {
    border: 1px solid var(--cart-table-border);
    padding: 8px;
    color: var(--cart-table-text);
}

.cart-table th {
    background-color: var(--cart-table-header);
    color: var(--cart-title);
}

.cart-table td {
    border-color: var(--cart-table-border);
}

.cart-total {
    color: var(--cart-total-text);
}

.cart-actions .btn-warning {
    background-color: var(--cart-action-btn-bg);
    color: var(--cart-action-btn-text);
    border: none;
}

.cart-actions .btn-warning:hover {
    background-color: var(--cart-action-btn-hover-bg);
    color: var(--cart-action-btn-text);
}

.text-muted {
    color: var(--cart-empty-text) !important;
}

.cart-actions .btn {
    min-width: 180px;
}

@media (max-width: 768px) {
    .cart-bottom {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }

    .cart-actions {
        justify-content: flex-start;
    }
}
</style>