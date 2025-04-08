<script>
export default {
    name: 'Benefits'
};
</script>

<template>
    <section class="benefits-section py-5">
        <article class="container">
            <h2 class="text-center mb-4">Наши Преимущества</h2>
            <article class="row">
                <article class="col-md-4 text-center">
                    <i class="bi bi-truck" style="font-size: 2rem;"></i>
                    <h5 class="mt-2">Быстрая доставка</h5>
                    <p>Мы доставляем заказы в кратчайшие сроки.</p>
                </article>
                <article class="col-md-4 text-center">
                    <i class="bi bi-shield-check" style="font-size: 2rem;"></i>
                    <h5 class="mt-2">Гарантия качества</h5>
                    <p>Все товары проходят строгий контроль качества.</p>
                </article>
                <article class="col-md-4 text-center">
                    <i class="bi bi-headset" style="font-size: 2rem;"></i>
                    <h5 class="mt-2">Поддержка 24/7</h5>
                    <p>Наша служба поддержки работает круглосуточно.</p>
                </article>
            </article>
        </article>
    </section>
</template>


<style scoped>
.benefits-section {
    background-color: var(--benefits-bg);
    border-bottom: 1px solid var(--benefits-border);
}

.benefits-section h2 {
    color: var(--benefits-title);
}

.benefits-section h5,
.benefits-section p {
    color: var(--benefits-text);
}

.benefits-section i {
    color: var(--benefits-icon);
}
</style>