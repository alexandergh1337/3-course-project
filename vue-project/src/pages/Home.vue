<script>
import Navbar from '../components/Navbar.vue';
import ContactForm from '../components/ContactForm.vue';
import Footer from '../components/Footer.vue';
import FAQ from '../components/FAQ.vue';
import Carousel from '../components/Carousel.vue';
import ClientReviews from '../components/ClientReviews.vue';
import Benefits from '../components/Benefits.vue';
import PopularProducts from '../components/PopularProducts.vue';

export default {
  name: "Home",
  components: {
    Navbar,
    ContactForm,
    Footer,
    FAQ,
    Carousel,
    ClientReviews,
    Benefits,
    PopularProducts
  }
};
</script>

<template>

  <Navbar />

  <Carousel />

  <Benefits />

  <PopularProducts />

  <FAQ />

  <ClientReviews />

  <ContactForm />

  <Footer />
</template>
