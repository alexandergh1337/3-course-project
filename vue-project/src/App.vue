<script>
import Navbar from './components/Navbar.vue';
import ContactForm from './components/ContactForm.vue';
import Footer from './components/Footer.vue';
import FAQ from './components/FAQ.vue';
import Carousel from './components/Carousel.vue';
import ClientReviews from './components/ClientReviews.vue';

export default {
  name: "App",
  components: {
    Navbar,
    ContactForm,
    Footer,
    FAQ,
    Carousel,
    ClientReviews
  }
};
</script>

<template>
  <Navbar />

  <Carousel />

  <FAQ />

  <ClientReviews />

  <ContactForm />

  <Footer />
</template>
