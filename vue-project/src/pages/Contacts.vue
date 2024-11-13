<script>
import Navbar from '../components/Navbar.vue';
import Footer from '../components/Footer.vue';

export default {
    name: 'Contacts',
    components: {
        Navbar,
        Footer
    }
}
</script>

<template>
    <Navbar />

    <div>
        <h1>Контакты</h1>
        <p>Здесь будет информация о контактах.</p>
    </div>

    <Footer />
</template>


<style scoped>

</style>