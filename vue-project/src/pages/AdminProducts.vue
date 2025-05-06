<script>
import axios from 'axios'

export default {
    name: 'AdminProducts',
    data() {
        return {
            products: [],
            showCreate: false,
            editItem: null,
            form: { name: '', category: '', price: '', brand: '', image: '' }
        }
    },
    methods: {
        async createProduct() {
            await axios.post('/api/products', this.form)
            this.closeModal()
        },
        editProduct(product) {
            this.editItem = product
            this.form = { ...product }
            this.showCreate = false
        },
        async updateProduct() {
            await axios.patch(`/api/products/${this.editItem.id}`, this.form)
            this.closeModal()
        },
        async deleteProduct(id) {
            if (confirm('Удалить товар?')) {
                await axios.delete(`/api/products/${id}`)
            }
        },
        closeModal() {
            this.showCreate = false
            this.editItem = null
            this.form = { name: '', category: '', price: '', brand: '', image: '' }
        },
        formatPrice(price) {
            return new Intl.NumberFormat('ru-RU').format(price)
        }
    },
    mounted() {
        axios.get('http://localhost:8000/api/products')
            .then(response => {
                this.products = response.data
            })
            .catch(() => {
                this.products = []
            })
    }
}
</script>

<template>
    <article class="container my-5">
        <article class="d-flex justify-content-between align-items-center">
            <h1 class="mb-4">Управление товарами</h1>
            <button class="btn btn-primary mb-4" @click="showCreate = true">Добавить товар</button>
        </article>
        <article class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Изображение</th>
                        <th>Категория</th>
                        <th>Цена</th>
                        <th>Бренд</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id">
                        <td>{{ product.id }}</td>
                        <td>{{ product.name }}</td>
                        <td>
                            <img v-if="product.image" :src="product.image" :alt="product.name"
                                style="width: 60px; height: 60px; object-fit: contain; display: block; margin: 0 auto;" />
                        </td>
                        <td>{{ product.category }}</td>
                        <td>{{ formatPrice(product.price) }} ₽</td>
                        <td>{{ product.brand }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning me-2"
                                @click="editProduct(product)">Редактировать</button>
                            <button class="btn btn-sm btn-danger" @click="deleteProduct(product.id)">Удалить</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </article>

        <article v-if="showCreate || editItem" class="modal fade show d-block" tabindex="-1"
            style="background:rgba(0,0,0,0.3);">
            <article class="modal-dialog">
                <article class="modal-content">
                    <article class="modal-header">
                        <h5 class="modal-title">{{ editItem ? 'Редактировать' : 'Добавить' }} товар</h5>
                        <button type="button" class="btn-close" @click="closeModal"></button>
                    </article>
                    <form @submit.prevent="editItem ? updateProduct() : createProduct()">
                        <article class="modal-body">
                            <article class="mb-3">
                                <label class="form-label">Название</label>
                                <input v-model="form.name" class="form-control" required />
                            </article>
                            <article class="mb-3">
                                <label class="form-label">Категория</label>
                                <input v-model="form.category" class="form-control" />
                            </article>
                            <article class="mb-3">
                                <label class="form-label">Цена</label>
                                <input v-model.number="form.price" class="form-control" required type="number" />
                            </article>
                            <article class="mb-3">
                                <label class="form-label">Бренд</label>
                                <input v-model="form.brand" class="form-control" />
                            </article>
                            <article class="mb-3">
                                <label class="form-label">URL изображения</label>
                                <input v-model="form.image" class="form-control" />
                            </article>
                        </article>
                        <article class="modal-footer">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                            <button type="button" class="btn btn-secondary" @click="closeModal">Отмена</button>
                        </article>
                    </form>
                </article>
            </article>
        </article>
    </article>
</template>