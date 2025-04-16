<script>
export default {
    name: 'Carousel'
};
</script>

<template>
    <article id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <article class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </article>

        <article class="carousel-inner">
            <article class="carousel-item active">
                <img src="/src/assets/img/2149552421.jpg"
                    class="d-block w-100" alt="Товар 1">
                <article class="carousel-caption d-none d-md-block">
                    <h5>Лучшие устройства</h5>
                    <p>Откройте для себя новейшие технологии и гаджеты в нашем каталоге.</p>
                </article>
            </article>
            <article class="carousel-item">
                <img src="/src/assets/img/2147961771.jpg"
                    class="d-block w-100" alt="Товар 2">
                <article class="carousel-caption d-none d-md-block">
                    <h5>Скидки и акции</h5>
                    <p>Не пропустите наши специальные предложения на популярные устройства.</p>
                </article>
            </article>
            <article class="carousel-item">
                <img src="/src/assets/img/2149853138.jpg"
                    class="d-block w-100" alt="Товар 3">
                <article class="carousel-caption d-none d-md-block">
                    <h5>Новые поступления</h5>
                    <p>У нас всегда самые свежие новинки в мире техники.</p>
                </article>
            </article>
        </article>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Предыдущий</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Следующий</span>
        </button>
    </article>
</template>

<style scoped>
.carousel-item img {
    object-fit: cover;
    height: 80vh;
    max-height: 1000px;
}

@media (max-width: 768px) {
    .carousel-item img {
        height: 70vh;
    }
}
</style>
