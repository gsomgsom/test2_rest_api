<template>
  <layout-div>
        <div class="container">
            <h2 class="text-center mt-5 mb-3">Каталог товаров</h2>
            <div class="card">
                <div class="card-header">
                    <router-link to="/create"
                        class="btn btn-outline-primary"
                        >Новый товар
                    </router-link>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Описание</th>
                                <th width="320px">Действия</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr v-for="item in items" :key="item.id">
                                <td>{{item.name}}</td>
                                <td>{{item.price}}</td>
                                <td>{{item.description}}</td>
                                <td>
                                    <router-link :to="`/show/${item.id}`" class="btn btn-outline-info mx-1">Карточка</router-link>
                                    <router-link :to="`/edit/${item.id}`" class="btn btn-outline-success mx-1">Изменить</router-link>
                                    <button 
                                        @click="handleDelete(item.id)"
                                        className="btn btn-outline-danger mx-1">
                                        Удалить
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </layout-div>
</template>
 
<script>
import axios from 'axios';
import LayoutDiv from '../LayoutDiv.vue';
import Swal from 'sweetalert2'
 
export default {
  name: 'ItemList',
  components: {
    LayoutDiv,
  },
  data() {
    return {
      items:[]
    };
  },
  created() {
    this.fetchItemList();
  },
  methods: {
    fetchItemList() {
      axios.get('/api/items')
        .then(response => {
            this.items = response.data;
            return response
        })
        .catch(error => {
          return error
        });
    },
    handleDelete(id){
        Swal.fire({
            title: 'Вы уверены?',
            text: "Действие нельзя отменить!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Да, удалить!'
          }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/api/item/${id}`)
                .then( response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Товар успешно удалён!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.fetchItemList();
                    return response
                })
                .catch(error => {
                    Swal.fire({
                         icon: 'error',
                        title: 'Ошибка при удалении товара!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    return error
                });
            }
          })
    }
  },
};
</script>
