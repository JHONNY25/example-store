<template>
    <div class="card mb-5">
        <img class="card-img" :src="product.images[0]" :alt="product.name">
        <div class="card-body">
          <h4 class="card-title">{{ product.name }}</h4>
          <p class="card-text text-muted">{{ product.description }}</p>
          <div class="buy d-flex justify-content-between align-items-center">
             <a @click="pay(product.id)" class="btn btn-primary mt-3"><i class="fas fa-shopping-cart"></i>Comprar</a>
          </div>
        </div>
      </div>
</template>

<script>
    export default {
        data(){
            return{
                message:''
            }
        },
        props:['product'],
        methods:{
            async pay(productID){
                axios.post('/pay',{sku: productID})
                .then(response => {

                });
            }
        }
    }
</script>
