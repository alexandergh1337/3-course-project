<script>
import Navbar from './components/Navbar.vue';
import ContactForm from './components/ContactForm.vue';
import Footer from './components/Footer.vue';

export default {
  name: "App",
  components: {
    Navbar,
    ContactForm,
    Footer,
  }
};
</script>

<template>
  <Navbar />

  <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true"
        aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img style="height: 907px;"
          src="https://img.freepik.com/free-photo/top-view-devices-supplies-composition_23-2149552421.jpg?t=st=1729701269~exp=1729704869~hmac=528f491dae3bde40b7287d6c734aee6dcbe5e20fbbfd4c2e5629edf8ed91f792&w=1380"
          class="d-block w-100" alt="Товар 1">
        <div class="carousel-caption d-none d-md-block">
          <h5>Лучшие устройства 2024</h5>
          <p>Откройте для себя новейшие технологии и гаджеты в нашем каталоге.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img style="height: 907px;"
          src="https://img.freepik.com/free-photo/toy-supermarket-carts-with-sale-tablet_23-2147961771.jpg?t=st=1729701779~exp=1729705379~hmac=6199115ab8ba2dc98793d4535cb2de3cb7cebcbf8abc4e808e1e8a33b98c197a&w=1380"
          class="d-block w-100" alt="Товар 2">
        <div class="carousel-caption d-none d-md-block">
          <h5>Скидки и акции</h5>
          <p>Не пропустите наши специальные предложения на популярные устройства.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img style="height: 907px;"
          src="https://img.freepik.com/free-photo/high-angle-forklift-carrying-boxes_23-2149853138.jpg?t=st=1729701900~exp=1729705500~hmac=446361e2179a91f7b8acc88b9f6ea77a127217189e5c8f7f70f7b4ddba441a5c&w=1380"
          class="d-block w-100" alt="Товар 3">
        <div class="carousel-caption d-none d-md-block">
          <h5>Новые поступления</h5>
          <p>У нас всегда самые свежие новинки в мире техники.</p>
        </div>
      </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Предыдущий</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Следующий</span>
    </button>
  </div>

  <ContactForm />

  <Footer />
</template>

<style scoped></style>
