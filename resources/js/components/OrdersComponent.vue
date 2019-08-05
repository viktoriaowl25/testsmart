<template>

<div class="orders-page">
    <div class="col-12 mt-4 b-order-list mb-5">
            <div class="b-order-list__item row mt-2 p-2"  v-for="order in orders">

                <div class="col-4 my-auto py-3 px-4 b-order-list__info">
                    <div class="mb-3">
                        <span class="mr-2">ID:</span><span>{{order.id}}</span>
                    </div>
                    <div class="mb-3">
                        <span class="mr-2">User:</span><span>{{order.user.name}}</span>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3" v-bind:id="createIDStatus(order.id, 'current')">Current Status: {{order.status.title}}</div>

                        <div class="form-group">
                            <select class="form-control" v-bind:id="createIDStatus(order.id, 'select')">
                                <option v-bind:value="status.id" v-for="status in statuses">{{ status.title }}</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <button @click="saveChange(order.id)" class="btn btn-success">Save status</button>
                    </div>
                </div>
                <div class="col-8 m-auto px-4">
                    <h5>Products:</h5>
                  
                    <ul class="list-group">
                        <li class="b-order-list__product list-group-item d-flex justify-content-between"  v-for="product in order.products">
                            <div class="mr-2">{{ product.name }}</div>    
                            <div class="font-weight-bold text-right">price: {{ product.price }}</div>        
                        </li>
                    </ul>
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
                var status_id = document.getElementById('select-status-' + orderID).value;
                axios.put('/api/orders/'+ orderID, {'id':JSON.stringify(this.productsToBasket), 'status_id': status_id, 'api_token': this.user.api_token})
                    .then( (response) => {
                        if(response.data.order) {
                            document.getElementById('current-status-' + orderID).innerHTML = 'Current Status: ' + response.data.order.status.title;    
                            document.getElementById('select-status-' + orderID).classList.remove("error");
                        } else {
                            document.getElementById('select-status-' + orderID).classList.add("error");
                        }
                        
                })
                .catch( (error) => {
                    console.log(error);
                });
                    
            },
            createIDStatus: function(orderID, preString) {
                return preString + '-status-' + orderID;
            }
        }
    }
</script>
