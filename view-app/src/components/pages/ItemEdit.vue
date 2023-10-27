<template>
   <layout-div>
        <h2 class="text-center mt-5 mb-3">Редактирование товара</h2>
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
                            rows="3"
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
                        Save Item
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
  name: 'ItemEdit',
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
  created() {
    const id = this.$route.params.id;
    axios.get(`/api/item/${id}`)
    .then(response => {
        let itemInfo = response.data
        this.item.name = itemInfo.name
        this.item.description = itemInfo.description
        this.item.price = itemInfo.price
        return response
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Ошибка при получении карточки товара!',
            showConfirmButton: false,
            timer: 1500
        })
        return error
    })
  },
  methods: {
    handleSave() {
        this.isSaving = true
        const id = this.$route.params.id;
        axios.put(`/api/item/${id}`, this.item)
          .then(response => {
            Swal.fire({
                icon: 'success',
                title: 'Товар успешно отредактирован!',
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
                title: 'Ошибка при редактировании товара!',
                showConfirmButton: false,
                timer: 1500
            })
            return error
          });
    },
  },
};
</script>