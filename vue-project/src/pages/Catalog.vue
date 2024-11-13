<script>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';

export default {
    name: 'Catalog',
    components: {
        Navbar,
        Footer
    }
}
</script>

<template>
    <Navbar />

    <div>
        <h1>Каталог</h1>
        <p>Здесь будет информация о каталоге.</p>
    </div>

    <Footer />
</template>


<style scoped>

</style>