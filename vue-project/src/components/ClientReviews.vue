<script>
export default {
    name: 'ClientReviews',
    data() {
        return {
            reviews: [
                {
                    name: "Анна Иванова",
                    date: "15-10-2024",
                    text: "Отличный магазин! Быстрая доставка и качественные товары. Очень довольна покупкой.",
                    rating: 5,
                    avatar: "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/340px-Default_pfp.svg.png"
                },
                {
                    name: "Дмитрий Сидоров",
                    date: "20-10-2024",
                    text: "Прекрасный сервис, менеджеры помогли выбрать подходящий товар. Всем рекомендую!",
                    rating: 4,
                    avatar: "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/340px-Default_pfp.svg.png"
                },
                {
                    name: "Ольга Петрова",
                    date: "22-10-2024",
                    text: "Заказала телефон, доставка была на следующий день. Супер!",
                    rating: 5,
                    avatar: "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/340px-Default_pfp.svg.png"
                }
            ]
        };
    }
};
</script>

<template>
    <section class="client-reviews-section py-5">
        <article class="container">
            <h2 class="text-center mb-4">Отзывы наших клиентов</h2>
            <article class="row">
                <article class="col-md-4" v-for="(review, index) in reviews" :key="index">
                    <article class="card mb-4">
                        <article class="card-body">
                            <article class="d-flex align-items-center mb-3">
                                <img :src="review.avatar" alt="avatar" class="avatar me-3">
                                <article>
                                    <h5 class="card-title mb-0">{{ review.name }}</h5>
                                    <h6 class="card-subtitle text-muted mt-1">{{ review.date }}</h6>
                                </article>
                            </article>
                            <p class="card-text">{{ review.text }}</p>
                            <article class="rating">
                                <span v-for="star in 5" :key="star" class="bi"
                                    :class="star <= review.rating ? 'bi-star-fill' : 'bi-star'"></span>
                            </article>
                        </article>
                    </article>
                </article>
            </article>
        </article>
    </section>
</template>

<style scoped>
.client-reviews-section {
    background-color: var(--reviews-bg);
    padding: 4rem 0;
    margin: 0;
    border-bottom: 1px solid var(--reviews-card-border);
}

.container {
    margin: 0 auto;
    padding: 0 1rem;
}

.card {
    background-color: var(--reviews-card-bg);
    border-color: var(--reviews-card-border);
}

h2 {
    color: var(--reviews-title);
}

.card-title {
    color: var(--reviews-name);
}

.card-subtitle {
    color: var(--reviews-date) !important;
}

.card-text {
    color: var(--reviews-text);
}

.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.rating .bi-star-fill {
    color: var(--star-filled);
}

.rating .bi-star {
    color: var(--star-empty);
}

.client-reviews-section .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.client-reviews-section .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px var(--reviews-hover-shadow);
}
</style>
