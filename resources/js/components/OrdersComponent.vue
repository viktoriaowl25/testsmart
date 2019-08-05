<template>

<div class="orders-page">
    <div class="col-12 mt-4 b-order-list mb-5">
            <div class="b-order-list__item row mt-2 p-2"  v-for="order in orders">
                <div class="co-2 my-auto">
                    <span>{{order.id}}</span>
                </div>
                <div class="col-6 row">
                    <div class="col my-auto">
                        <span>User: {{order.user.name}}</span>
                    </div>
                    <div class="col my-auto">
                        <span>Status: {{order.status.title}}</span>

                        <div class="form-group">
                            <select class="form-control" @change="changeStatus(order.id)">
                                <option v-bind:value="status.id" v-for="status in statuses">{{ status.title }}</option>
                            </select>
                        </div>
                    </div>    
                </div>

                <div class="col-auto row mt-3 b-order-list__products">
                    <h5>Products:</h5>
                  
                    <ul class="">
                        <li class="b-order-list__product"  v-for="product in order.products">
                            <span class="mr-2">{{ product.name }}</span>    
                            <span class="font-weight-bold">{{ product.price }}</span>        
                        </li>
                    </ul> 
                 
                </div>

                <div class="col my-auto text-right">
                    <button @click="saveChange(order.id)" class="btn btn-success">Save status</button>
                </div>
            </div> 
    </div>


</div>

</template>

<script>
    export default {
        data: function(){
            return {
   
            }
        },
        props:[
            'orders',
            'user',
            'statuses'
        ],
        mounted() {
            //
        },
        methods:{
            saveChange: function(orderID){
                axios.put('/api/orders', {'id':JSON.stringify(this.productsToBasket), 'status_id': '', 'api_token': this.user.api_token})
                    .then( (response) => {
     
                })
                .catch( (error) => {
                    console.log(error);
                });
                    
            },
        }
    }
</script>
