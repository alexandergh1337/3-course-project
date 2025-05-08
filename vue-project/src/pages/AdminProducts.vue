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
        getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        },
        async fetchProducts() {
            try {
                const response = await axios.get('http://localhost:8000/api/products', { withCredentials: true });
                this.products = response.data;
            } catch {
                this.products = [];
            }
        },
        async createProduct() {
            try {
                await axios.get('http://localhost:8000/sanctum/csrf-cookie', { withCredentials: true });
                const xsrfToken = decodeURIComponent(this.getCookie('XSRF-TOKEN') || '');
                await axios.post('http://localhost:8000/api/products', this.form, {
                    withCredentials: true,
                    headers: { 'X-XSRF-TOKEN': xsrfToken }
                });
                this.closeModal();
                await this.fetchProducts();
            } catch (e) {
                alert('Ошибка при создании товара');
            }
        },
        editProduct(product) {
            this.editItem = product;
            this.form = { ...product };
            this.showCreate = false;
        },
        async updateProduct() {
            try {
                await axios.get('http://localhost:8000/sanctum/csrf-cookie', { withCredentials: true });
                const xsrfToken = decodeURIComponent(this.getCookie('XSRF-TOKEN') || '');
                await axios.patch(`http://localhost:8000/api/products/${this.editItem.id}`, this.form, {
                    withCredentials: true,
                    headers: { 'X-XSRF-TOKEN': xsrfToken }
                });
                this.closeModal();
                await this.fetchProducts();
            } catch (e) {
                alert('Ошибка при обновлении товара');
            }
        },
        async deleteProduct(id) {
            if (confirm('Удалить товар?')) {
                try {
                    await axios.get('http://localhost:8000/sanctum/csrf-cookie', { withCredentials: true });
                    const xsrfToken = decodeURIComponent(this.getCookie('XSRF-TOKEN') || '');
                    await axios.delete(`http://localhost:8000/api/products/${id}`, {
                        withCredentials: true,
                        headers: { 'X-XSRF-TOKEN': xsrfToken }
                    });
                    await this.fetchProducts();
                } catch (e) {
                    alert('Ошибка при удалении товара');
                }
            }
        },
        closeModal() {
            this.showCreate = false;
            this.editItem = null;
            this.form = { name: '', category: '', price: '', brand: '', image: '' };
        },
        formatPrice(price) {
            return new Intl.NumberFormat('ru-RU').format(price);
        },
        closeModalOnBackdrop(e) {
            if (e.target === e.currentTarget) {
                this.closeModal();
            }
        },
    },
    mounted() {
        this.fetchProducts();
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
            <table class="admin-table table align-middle">
                <thead>
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
                            <img v-if="product.image" :src="product.image" :alt="product.name" />
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
            style="background:rgba(0,0,0,0.3);" @mousedown.self="closeModalOnBackdrop">
            <article class="modal-dialog">
                <article class="modal-content" @mousedown.stop>
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

<style scoped>
h1 {
    color: var(--admin-title);
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    background-color: var(--admin-table-bg);
    border: 1px solid var(--admin-table-border);
}


.admin-table th,
.admin-table td {
    border: 1px solid var(--admin-table-border);
    padding: 8px;
    color: var(--admin-table-text);
    background-color: var(--admin-table-bg);
}

.admin-table th {
    background-color: var(--admin-table-header-bg);
    color: var(--admin-table-header-text);
    font-weight: 600;
}

.admin-table img {
    display: block;
    margin: 0 auto;
    width: 60px;
    height: 60px;
    object-fit: contain;
}

.modal-content {
    background-color: var(--form-bg);
    color: var(--form-title);
    border-radius: 10px;
    border: 1px solid var(--input-border);
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.18);
}

.modal-header {
    background: none;
    border-bottom: 1px solid var(--input-border);
}

.modal-title {
    color: var(--form-title);
    font-weight: 600;
}

.modal-body {
    background: none;
}

.modal-footer {
    background: none;
    border-top: 1px solid var(--input-border);
}

.form-label {
    color: var(--form-label);
}

.form-control {
    background-color: var(--input-bg);
    color: var(--input-text);
    border: 1px solid var(--input-border);
    border-radius: 6px;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-control:focus {
    background-color: var(--input-bg);
    color: var(--input-text);
    border-color: var(--input-focus-border);
    box-shadow: 0 0 0 0.2rem var(--input-focus-shadow);
}

[data-theme="dark"] .btn-close {
    filter: brightness(0) invert(1);
    opacity: 0.8;
}

[data-theme="dark"] .btn-close:hover {
    opacity: 1;
}
</style>