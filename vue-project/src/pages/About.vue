<script>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';

export default {
    name: 'About',
    components: {
        Navbar,
        Footer
    }
}
</script>

<template>
    <Navbar />

    <div>
        <h1>О нас</h1>
        <p>Здесь будет информация о нас.</p>
    </div>

    <Footer />
</template>


<style scoped>

</style>