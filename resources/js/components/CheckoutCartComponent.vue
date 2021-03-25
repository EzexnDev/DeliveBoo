<template>
    <div class="checkout-container container">
        <div class="checkout-cart">
            <h2>Stai ordinando...</h2>
            <template v-if="cart">
                <p v-if="cart.items.length < 1">Il tuo carrello è vuoto</p>
                <div class="checkout-items" v-for="it in cart.items" :key="it.id">
                    <div class="single-item">
                        <span>{{it.qty}}</span>
                        <span>{{it.name}}</span>
                    </div>
                    <div class="single-item-price">
                        <span>{{(it.price * it.qty).toFixed(2)}} €</span>
                    </div>
                </div>
            </template>
        </div>
     </div>
</template>

<script>
import { bus } from '../main.js';
export default {
   data(){
            return{
                cart:{
                    items:[],
                    totalPrice:0,
                    totalQty:0,
                }
            }
        },
        mounted() {
            if (localStorage.getItem('carts')) {
                try {
                    this.cart = JSON.parse(localStorage.getItem('carts'));
                    if(this.cart.items[0].restaurant_id != this.restaurant.id){
                    } else {
                        this.passData();
                    }
                } catch(e) {
                    localStorage.removeItem('carts');
                }
            }
        },
        methods: {
            passData(){
                bus.$emit('passing-total-price', this.cart.totalPrice);
            },
        }
}
</script>

<style lang="scss">

.checkout-container {
    width: 100%;
    display: flex;
    justify-content: center;
}

.checkout-cart {
    display: flex;
    flex-direction: column;
    justify-content: center;
    background-color: #fff;
    color: #5433ff;
    padding: 10px 20px;
    border-radius: 10px;
}

.checkout-items {
    display: flex;
    .single-item-price {
        margin-left: 10px;
        span {
            font-weight: 700;
        }
    }
}


</style>