<template>
   <layout-div>
        <h2 class="text-center mt-5 mb-3">Карточка товара</h2>
        <div class="card">
            <div class="card-header">
                <router-link 
                    class="btn btn-outline-info float-right"
                    to="/">Каталог товаров
                </router-link>
            </div>
            <div class="card-body">
                <b className="text-muted">Название:</b>
                <p>{{item.name}}</p>
                <b className="text-muted">Описание:</b>
                <p>{{item.description}}</p>
                <b className="text-muted">Цена:</b>
                <p>{{item.price}}</p>
            </div>
        </div>
   </layout-div>
</template>
 
<script>
import axios from 'axios';
import LayoutDiv from '../LayoutDiv.vue';
import Swal from 'sweetalert2'
 
export default {
  name: 'ItemShow',
  components: {
    LayoutDiv,
  },
  data() {
    return {
      item: {
        name: '',
        description: '',
        price: '',
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
     
  },
};
</script>
