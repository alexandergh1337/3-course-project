<script>
import Navbar from "../components/Navbar.vue";
import Footer from "../components/Footer.vue";

export default {
    name: 'Cart',
    components: {
        Navbar,
        Footer,
    },
    data() {
        return {
            cart: [
                { id: 1, name: 'iPhone 15 Pro', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/e853c72719633e353b65193e301cc9e9/8517b5d57caefeef97194196729bd221e1606cafc9a005f423b21eb56314ba96.jpg.webp', price: 120000, quantity: 1 },
                { id: 2, name: 'Sony WH-1000XM5', image: 'https://c.dns-shop.ru/thumb/st4/fit/500/500/92f5097a5043cd3526f7b4f492d02459/2df2632475190df8324dd72376786ed737facef7dc387bf5fcd76f88d5fc28ec.jpg.webp', price: 25000, quantity: 2 },
                { id: 3, name: 'MacBook Air M2', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/318259187cb6d5356730f526caa8ae93/f90f6266dac6bf12212723b31fa2a073677c5ca54cefbc551f8d896ae1a67af5.jpg.webp', price: 110000, quantity: 1 }
            ],
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
        },
        removeItem(item) {
            this.cart = this.cart.filter(i => i.id !== item.id);
            if (this.cartPage > this.cartTotalPages) {
                this.cartPage = this.cartTotalPages || 1;
            }
        }
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
                        <th style="text-align: center;">Изображение</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Сумма</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in paginatedCart" :key="item.id">
                        <td>{{ item.name }}</td>
                        <td style="text-align: center;">
                            <img :src="item.image" :alt="item.name" style="width: 60px; height: 60px; object-fit: contain; display: block; margin: 0 auto;" />
                        </td>
                        <td>{{ formatPrice(item.price) }} ₽</td>
                        <td>
                            <input type="number" min="1" v-model.number="item.quantity" @input="updateQuantity(item, $event)" style="width: 70px; text-align: center;" />
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
                    <button class="btn btn-warning text-white">Оформить заказ</button>
                </article>
            </article>
            <nav v-if="cartTotalPages > 1" class="d-flex justify-content-center mt-4">
                <ul class="pagination">
                    <li class="page-item" :class="{ disabled: cartPage === 1 }">
                        <a class="page-link" href="#" @click.prevent="changeCartPage(cartPage - 1)">&laquo;</a>
                    </li>
                    <li v-for="page in cartTotalPages" :key="page" class="page-item" :class="{ active: cartPage === page }">
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
.cart-table th, .cart-table td {
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