<script>
export default {
    name: 'FAQ'
};
</script>

<template>
    <section class="faq-section py-5">
        <article class="container">
            <h2 class="text-center mb-4">Часто задаваемые вопросы</h2>
            <article class="accordion" id="faqAccordion">
                <article class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                            Какие виды техники вы предлагаете?
                        </button>
                    </h2>
                    <article id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1"
                        data-bs-parent="#faqAccordion">
                        <article class="accordion-body">
                            Мы предлагаем широкий ассортимент электроники: от смартфонов и ноутбуков до бытовой техники
                            и аксессуаров.
                        </article>
                    </article>
                </article>

                <article class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                            Как оформить заказ?
                        </button>
                    </h2>
                    <article id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2"
                        data-bs-parent="#faqAccordion">
                        <article class="accordion-body">
                            Выберите нужный товар, добавьте его в корзину и следуйте инструкциям для завершения покупки.
                        </article>
                    </article>
                </article>

                <article class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                            Какие методы оплаты вы принимаете?
                        </button>
                    </h2>
                    <article id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3"
                        data-bs-parent="#faqAccordion">
                        <article class="accordion-body">
                            Мы принимаем оплату картами, банковским переводом и через электронные кошельки.
                        </article>
                    </article>
                </article>

                <article class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                            Есть ли у вас гарантия на товары?
                        </button>
                    </h2>
                    <article id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4"
                        data-bs-parent="#faqAccordion">
                        <article class="accordion-body">
                            Да, на все товары предоставляется гарантия в соответствии с законодательством.
                        </article>
                    </article>
                </article>

                <article class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading5">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                            Можно ли вернуть или обменять товар?
                        </button>
                    </h2>
                    <article id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5"
                        data-bs-parent="#faqAccordion">
                        <article class="accordion-body">
                            Да, товар можно вернуть или обменять в течение 14 дней при соблюдении условий возврата.
                        </article>
                    </article>
                </article>

                <article class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading6">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6">
                            Какие способы доставки вы предлагаете?
                        </button>
                    </h2>
                    <article id="faqCollapse6" class="accordion-collapse collapse" aria-labelledby="faqHeading6"
                        data-bs-parent="#faqAccordion">
                        <article class="accordion-body">
                            Мы предлагаем доставку курьером, самовывоз из магазина и почтовую доставку.
                        </article>
                    </article>
                </article>
            </article>
        </article>
    </section>
</template>

<style scoped>
.faq-section {
    background-color: var(--faq-bg);
    padding: 4rem 0;
    margin: 0;
    border-bottom: 1px solid var(--accordion-border);
}

.container {
    margin: 0 auto;
    padding: 0 1rem;
}

.faq-section h2 {
    font-weight: 700;
    color: var(--faq-title);
}

.accordion-item {
    background-color: var(--accordion-bg);
    border-color: var(--accordion-border);
}

.accordion-button {
    background-color: var(--accordion-button);
    color: var(--faq-text);
}

.accordion-button:not(.collapsed) {
    background-color: var(--accordion-button-active);
    color: var(--faq-text);
}

.accordion-button::after {
    filter: var(--icon-filter);
}

.accordion-body {
    color: var(--faq-text);
    background-color: var(--accordion-bg);
}
</style>
