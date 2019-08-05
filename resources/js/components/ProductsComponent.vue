<template>

<div class="products-page">
    <div class="col-12 mt-4 b-product-list mb-5">
            <div class="b-product-list__item row mt-2 p-2"  v-for="product in products">
                <div class="col my-auto">
                    <span>{{product.name}}</span></div>
                <div class="col my-auto">
                    <span>Article: {{product.vendor_code}}</span>
                </div>
                <div class="col my-auto font-weight-bold">
                    <span>Price: {{product.price}}</span>
                </div>
                <div class="col my-auto text-right">
                    <button @click="addToBasket(product.id)" class="btn btn-success" v-if="!checkState(product.id)">Add to order</button>
                    <button @click="deleteToBasket(product.id)" class="btn btn-danger" v-if="checkState(product.id)">Delete to order</button>
                </div>
            </div> 
    </div>

    <div class="mt-5 b-check col-6 bg-white p-4">
        <h2 class="b-check__title font-weight-bold mb-4">Your Check</h2>
            <div class="b-check__products">
                <div class="b-check__product d-flex justify-content-between" v-for="productInfo in productsInfo" >
                    <div>{{ productInfo.name }}</div>
                    <div class="font-weight-bold">{{ productInfo.price }}</div>
                </div>
                <hr>
            </div>
                        
            <div class="b-check__total d-flex justify-content-between mt-4">
                <h3>Total</h3>
                <div class="font-weight-bold">{{ totalPrice }}</div>
            </div>
            <hr>
            <div class="b-check__btn text-right">
                <button type="button" class="btn btn-info" v-if="!is_created" @click="onCreateOrder">Create Order</button>
            </div>

            <div v-if="is_created" class="alert alert-success">
                The order is formed, its number {{ numberOrder }}
            </div>
    </div>

</div>

</template>

<script>
    export default {
        data: function(){
            return {
                productsToBasket : [],
                productsInfo : {},
                is_created : false,
                totalPrice: 0,
                numberOrder: ''
            }
        },
        props:[
            'products',
            'user'
        ],
        mounted() {
            //
        },
        methods:{
            onCreateOrder: function(){
                axios.post('/api/orders', {'products':JSON.stringify(this.productsToBasket), 'api_token': this.user.api_token})
                    .then( (response) => {
     
                    this.numberOrder = response.data.order.id;
                    this.is_created = true;
                    this.productsToBasket = [];
                    this.productsInfo = [];
                    this.totalPrice = 0;
                })
                .catch( (error) => {
                    console.log(error);
                });
                    
            },
            addToBasket: function(productId){
                this.productsToBasket.push(productId);
                for(var i=0; i<this.products.length;i++) {
                    if(this.products[i].id == productId) {
                        this.productsInfo[productId] = this.products[i];
                        this.totalPrice = parseInt(this.totalPrice) + parseInt(this.products[i].price);
                    }
                }

            },
            deleteToBasket: function(productId){
                var productsToBasketNew = [];
                for(var i = 0; i < this.productsToBasket.length; i++) {
                    if(this.productsToBasket[i]!=productId){
                        productsToBasketNew.push(this.productsToBasket[i]);
                    }
                }
                this.productsToBasket = productsToBasketNew;
                this.totalPrice = parseInt(this.totalPrice) - parseInt(this.productsInfo[productId].price);
                delete this.productsInfo[productId];
            },
            checkState: function(productId){
                return this.productsToBasket.includes(productId);
            }
        }
    }
</script>
