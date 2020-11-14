<template>
    <div class="container">
        <h2 class="mb-5">Productos</h2>
        <div class="row">
            <div class="col-md-4" v-for="(product,index) in products" :key="index">
                <product-card :product="product"></product-card>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductCard from '../components/ProductCard'
    export default {
        data(){
            return {
                products:[]
            }
        },
        components:{
            ProductCard
        },
        methods:{
            async getProducts(){
                await axios.get('/get-products')
                .then(response => {
                    this.products = response.data.data
                })
                .catch(error => console.log(error))
            },
        },
        created(){
            this.getProducts()
        }
    }
</script>

