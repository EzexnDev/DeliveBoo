<template>
    <div class="container-list">
        <div class="restaurant-header">
            <div class="restaurant-details">
                <h1 class="restaurant-name">
                    {{ restaurant.name }}
                </h1>
                <div class="info">
                    <div class="icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <p>
                        {{ restaurant.shortDescription }}
                    </p>
                </div>
                <div class="info">
                    <div class="icon">
                        <i class="fas fa-store-slash"></i>
                    </div>
                    <p>
                        Giorno di chiusura: {{ restaurant.closeDay }}
                    </p>
                </div>
                <div class="info">
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <p>
                        Orari di consegna: {{ restaurant.deliveryHours }}
                    </p>
                </div>
                <div class="info">
                    <div class="icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <p>
                        {{ restaurant.phone }}
                    </p>
                </div>
            </div>
            <div class="restaurant-picture" v-bind:style="{ backgroundImage: 'url(' + restaurant.imgUrl + ')' }">
                <!-- <img :src="restaurant.imgUrl" alt=""> -->
            </div>
        </div>
        <div class="main-container">
            <div class="menu-container">
                <div v-for="item in menuitems" :key="item.id">
                    <div v-if="restaurant.id == item.restaurant_id && item.isActive == true && item.isDeleted == false" class="menu-item-card">
                        <div class="menu-item-info">
                            <div class="item-name">
                                <h3>
                                    {{ item.name }}
                                </h3>
                            </div>
                            <div class="item-description">
                                <p>
                                    {{ item.description }}
                                </p>
                            </div>
                        </div>
                        <div class="menu-item-price">
                            <div @click="addItem(item)" class="item-button">
                                <a href="#" v-bind:class="addItem">
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="item-price">
                                <h4>
                                    {{ item.price.toFixed(2) }} €
                                </h4>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="cart-container">
                <div class="cart">
                    <template v-if="cart">
                        <p v-if="cart.items.length < 1">Il tuo carrello è vuoto</p>
                        <div class="item-cart" v-for="it in cart.items" :key="it.id">
                            <div class="item-cart-quantity">
                                <button class="quantity-button" @click="removeItem(it)">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <span>{{ it.qty}}</span>
                                <button class="quantity-button" @click="addItem(it)">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                            <span class="item-cart-name">{{it.name}}</span>
                            <span class="item-cart-price">{{(it.price * it.qty).toFixed(2)}} €</span>
                            <button class="delete-item-cart" @click="removeAllItems(it)">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                        <div class="cart-tot" v-if="cart.items.length > 0">
                            <div>Totale: {{cart.totalPrice.toFixed(2)}} €</div>
                            <form id="app" action = "/orders/create" method =" post"> 
                                <input id="totalPrice" type="hidden" v-model="showTotalPrice" name="totalPrice" step="0.01" min="0.00">
                                <input id="itemsId" type="hidden" v-model="showItemsId" name="itemsId">
                                <input id="itemsQty" type="hidden" v-model="showItemsQty" name="itemsQty">
                                <input class="checkout-button" type="submit" value="Vai al pagamento">   
                            </form>
                        </div>
                    </template>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { bus } from '../main.js';

    export default {

        props: ['restaurant', 'menuitems'],
        data(){
            return{
                cart:{
                    items:[],
                    totalPrice:0,
                    totalQty:0,
                },
                itemsId : [],
                itemsQty : [],
            }
        },
        mounted() {
            if (localStorage.getItem('carts') && localStorage.getItem('ids') && localStorage.getItem('qty')) {
                try {
                    this.cart = JSON.parse(localStorage.getItem('carts'));
                    this.itemsId = JSON.parse(localStorage.getItem('ids'));
                    this.itemsQty = JSON.parse(localStorage.getItem('qty'));
                    if(this.cart.items[0].restaurant_id != this.restaurant.id){
                        localStorage.clear();
                        this.cart = {
                            items:[],
                            totalPrice:0,
                            totalQty:0,
                        };
                        this.itemsId = [];
                        this.itemsQty = [];
                    } else {
                        this.passData();
                    }
                } catch(e) {
                    localStorage.removeItem('carts');
                    localStorage.removeItem('ids');    
                    localStorage.removeItem('qty');    
                }
            }
        },
        computed:{
            showTotalPrice(){
                return this.cart.totalPrice;
            },
            showItemsId(){
                return this.itemsId.toString();
            },
            showItemsQty(){
                return this.itemsQty.toString();
            }
        },
        methods: {
            passData(){
                bus.$emit('passing-total-price', this.cart.totalPrice);
            },
            addItem(item) {
            // ensure they actually typed something
            console.log(item.qty);
                
                console.log('incluso?prima',this.cart.items.includes(item));
                //se non ha la qty aggiungila a 0
                if(!(item.hasOwnProperty('qty'))){
                    item.qty = 0;
                }
                console.log('doposet',item.qty);
                console.log('incluso?dopo',this.cart.items.includes(item));


                if(this.cart.items.includes(item)){
                    item.qty += 1;
                    let index=this.cart.items.indexOf(item);
                    this.itemsQty.splice(index,1,item.qty);
                }else{
                    this.itemsQty.push(1);
                    this.itemsId.push(item.id);
                    item.qty = 1;
                    console.log('sto pushando')
                    this.cart.items.push(item);
                }
                this.cart.totalPrice += item.price;
                this.cart.totalQty++;
                this.saveItem();
            },
            removeItem(item) {
                this.cart.totalQty -= 1;
                this.cart.totalPrice -= item.price;

                if(this.cart.items.includes(item)){
                    item.qty -= 1;
                    let index=this.cart.items.indexOf(item);
                    this.itemsQty.splice(index,1,item.qty);
                    if(item.qty < 1){
                        //let index=this.cart.items.indexOf(item);
                        if(index >= 0) {
                            this.cart.items.splice(index,1);
                            this.itemsId.splice(index,1);
                            this.itemsQty.splice(index,1);
                            console.log('passo di qua!');
                        }
                    }
                }
                this.saveItem();
            },
            removeAllItems: function(item) {
                this.cart.totalQty -= item.qty;
                this.cart.totalPrice -= item.price * item.qty;

                let index=this.cart.items.indexOf(item);
                if(index >= 0) {
                    this.cart.items.splice(index,1);
                    this.itemsId.splice(index,1);
                    this.itemsQty.splice(index,1);
                }
                //localStorage.removeItem(item);
                this.saveItem();
            },
            saveItem() {
                this.passData();
                const parsed = JSON.stringify(this.cart);
                localStorage.setItem('carts', parsed);
                const parsedId = JSON.stringify(this.itemsId);
                localStorage.setItem('ids',parsedId);
                const parsedQty = JSON.stringify(this.itemsQty);
                localStorage.setItem('qty',parsedQty);
                //sessionStorage.setItem('carts',parsed);
            }
        }
    }
</script>
