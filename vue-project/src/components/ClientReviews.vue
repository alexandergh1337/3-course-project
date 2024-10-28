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
        <div class="container">
            <h2 class="text-center mb-4">Отзывы наших клиентов</h2>
            <div class="row">
                <div class="col-md-4" v-for="(review, index) in reviews" :key="index">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img :src="review.avatar" alt="avatar" class="avatar me-3">
                                <div>
                                    <h5 class="card-title mb-0">{{ review.name }}</h5>
                                    <h6 class="card-subtitle text-muted mt-1">{{ review.date }}</h6>
                                </div>
                            </div>
                            <p class="card-text">{{ review.text }}</p>
                            <div class="rating">
                                <span v-for="star in 5" :key="star" class="bi"
                                    :class="star <= review.rating ? 'bi-star-fill' : 'bi-star'"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.client-reviews-section {
    background-color: #f8f9fa;
}

.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.rating .bi-star-fill {
    color: #ffc107;
}

.rating .bi-star {
    color: #ddd;
}
</style>
