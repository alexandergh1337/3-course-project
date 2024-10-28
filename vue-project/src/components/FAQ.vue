<script>
export default {
    name: 'FAQ'
};
</script>

<template>
    <section class="faq-section py-5">
        <div class="container">
            <h2 class="text-center mb-4">Часто задаваемые вопросы</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                            Какие виды техники вы предлагаете?
                        </button>
                    </h2>
                    <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Мы предлагаем широкий ассортимент электроники: от смартфонов и ноутбуков до бытовой техники
                            и аксессуаров.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                            Как оформить заказ?
                        </button>
                    </h2>
                    <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Выберите нужный товар, добавьте его в корзину и следуйте инструкциям для завершения покупки.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                            Какие методы оплаты вы принимаете?
                        </button>
                    </h2>
                    <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Мы принимаем оплату картами, банковским переводом и через электронные кошельки.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                            Есть ли у вас гарантия на товары?
                        </button>
                    </h2>
                    <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Да, на все товары предоставляется гарантия в соответствии с законодательством.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading5">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                            Можно ли вернуть или обменять товар?
                        </button>
                    </h2>
                    <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Да, товар можно вернуть или обменять в течение 14 дней при соблюдении условий возврата.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqHeading6">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6">
                            Какие способы доставки вы предлагаете?
                        </button>
                    </h2>
                    <div id="faqCollapse6" class="accordion-collapse collapse" aria-labelledby="faqHeading6"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Мы предлагаем доставку курьером, самовывоз из магазина и почтовую доставку.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.faq-section h2 {
    font-weight: 700;
}
</style>
