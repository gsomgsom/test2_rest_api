<template>
  <layout-div>
    <h2 class="text-center mt-5 mb-3">Добавление товара</h2>
    <div class="card">
        <div class="card-header">
            <router-link 
                class="btn btn-outline-info float-right"
                to="/">Каталог товаров
            </router-link>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label htmlFor="name">Название</label>
                    <input 
                        v-model="item.name"
                        type="text"
                        class="form-control"
                        id="name"
                        name="name"/>
                </div>
                <div class="form-group">
                    <label htmlFor="description">Описание</label>
                    <textarea 
                        v-model="item.description"
                        class="form-control"
                        id="description"
                        rows="2"
                        name="description"></textarea>
                </div>
                <div class="form-group">
                    <label htmlFor="price">Цена</label>
                    <input 
                        v-model="item.price"
                        type="text"
                        class="form-control"
                        id="price"
                        name="price"/>
                </div>
                <button 
                    @click="handleSave()"
                    :disabled="isSaving"
                    type="button"
                    class="btn btn-outline-primary mt-3">
                    Сохранить
                </button>
            </form>
        </div>
    </div>
  </layout-div>
</template>
 
<script>
import axios from 'axios';
import LayoutDiv from '../LayoutDiv.vue';
import Swal from 'sweetalert2'
 
export default {
  name: 'ItemCreate',
  components: {
    LayoutDiv,
  },
  data() {
    return {
      item: {
        name: '',
        description: '',
        price: '0',
      },
      isSaving:false,
    };
  },
  methods: {
    handleSave() {
        this.isSaving = true
        axios.post('/api/item', this.item)
          .then(response => {
            Swal.fire({
                icon: 'success',
                title: 'Товар успешно добавлен!',
                showConfirmButton: false,
                timer: 1500
            })
            this.isSaving = false
            this.item.name = ""
            this.item.description = ""
            this.item.price = "0"
            return response
          })
          .catch(error => {
            this.isSaving = false
            Swal.fire({
                icon: 'error',
                title: 'Ошибка при добавлении товара!',
                showConfirmButton: false,
                timer: 1500
            })
            return error
          });
    },
  },
};
</script>