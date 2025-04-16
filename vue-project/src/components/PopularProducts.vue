article<script>
export default {
    name: 'PopularProducts',
    data() {
        return {
            products: [
                { id: 1, name: 'Apple iPhone 15 Pro', price: '120 000 ₽', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/e853c72719633e353b65193e301cc9e9/8517b5d57caefeef97194196729bd221e1606cafc9a005f423b21eb56314ba96.jpg.webp' },
                { id: 2, name: 'Sony WH-1000XM5', price: '25 000 ₽', image: 'https://c.dns-shop.ru/thumb/st4/fit/500/500/92f5097a5043cd3526f7b4f492d02459/2df2632475190df8324dd72376786ed737facef7dc387bf5fcd76f88d5fc28ec.jpg.webp' },
                { id: 3, name: 'MacBook Air M2', price: '110 000 ₽', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/318259187cb6d5356730f526caa8ae93/f90f6266dac6bf12212723b31fa2a073677c5ca54cefbc551f8d896ae1a67af5.jpg.webp' },
                { id: 4, name: 'Apple Watch Series 9', price: '40 000 ₽', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/523dcc5680975cb8595118649c0ab4a8/d2e0a66b3fd2f505fa9a08426a170f381706d1046622d3deea4023da1f62a9df.jpg.webp' },
                { id: 5, name: 'LG OLED55C1', price: '90 000 ₽', image: 'https://c.dns-shop.ru/thumb/st4/fit/500/500/15a8751d34c63702d27cc555514dd872/8f587353f780a0e16074c87a2a74c8e2088f544857aee31eb69e4b5c4ca14868.jpg.webp' },
                { id: 6, name: 'Samsung Galaxy Tab S9', price: '60 000 ₽', image: 'https://c.dns-shop.ru/thumb/st4/fit/500/500/a5ed967fc7a9239d62fbd1fc2bdb1472/84b554da4de5b2a9ad8e243c4078034878fc077fc1f4fc9040d16762c143a84e.jpg.webp' },
                { id: 7, name: 'Sony PlayStation 5', price: '60 000 ₽', image: 'https://c.dns-shop.ru/thumb/st1/fit/500/500/d4c2d22f316a43bae74155ee37140f1e/18a00d64a85957b578be630af5bd9d6b7a33198b8128abad151a1c2563095d6f.jpg.webp' }
            ]
        };
    }
};
</script>

<template>
    <section class="popular-products-section py-5">
        <article class="container">
            <h2 class="text-center mb-4">Популярные товары</h2>
            <article class="row">
                <article class="col-md-4 mb-4" v-for="product in products" :key="product.id">
                    <article class="card h-100">
                        <img :src="product.image" class="card-img-top" :alt="product.name">
                        <article class="card-body text-center">
                            <h5 class="card-title">{{ product.name }}</h5>
                            <p class="card-text">{{ product.price }}</p>
                        </article>
                    </article>
                </article>
            </article>
            <article class="text-center mt-4">
                <router-link to="/catalog" class="btn btn-primary">Перейти в каталог</router-link>
            </article>
        </article>
    </section>
</template>

<style scoped>
.popular-products-section {
    background-color: var(--products-section-bg);
    padding: 4rem 0;
    margin: 0;
    border-bottom: 1px solid var(--card-border);
}

.container {
    margin: 0 auto;
    padding: 0 1rem;
}

.card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background-color: var(--card-bg);
    border-color: var(--card-border);
    transition: transform 0.3s ease;
    box-shadow: 0 4px 6px var(--card-shadow);
}

.card:hover {
    transform: translateY(-5px);
}

.card-img-top {
    height: 275px;
    object-fit: cover;
}

.card-body {
    padding: 15px;
}

.card-title {
    color: var(--card-title);
}

.card-text {
    color: var(--card-text);
}

h2 {
    color: var(--card-title);
}
</style>
