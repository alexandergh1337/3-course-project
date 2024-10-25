<script>
import Navbar from './components/Navbar.vue';
import ContactForm from './components/ContactForm.vue';
import Footer from './components/Footer.vue';
import FAQ from './components/FAQ.vue';
import Carousel from './components/Carousel.vue';

export default {
  name: "App",
  components: {
    Navbar,
    ContactForm,
    Footer,
    FAQ,
    Carousel
  }
};
</script>

<template>
  <Navbar />

  <Carousel />

  <FAQ />

  <ContactForm />

  <Footer />
</template>
