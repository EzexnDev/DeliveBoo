<template>
    <div class="navbar">
        <a :href="'/'">
            <img :src="logo" alt="Logo"/>
        </a>
        <div class="menu">
            <nav>
                <a class="cta-button" :href="'/login'">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Accedi</span>
                </a>
                <a class="cta-button" :href="'/register'">
                    <i class="fas fa-user"></i>
                    <span>Registrati</span>
                </a>
                <a v-if="cart.items.length > 0" :href="/restaurants/ + cart.items['0'].restaurant_id" class="cta-button">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <template v-if="this.totalprice">
                        {{ this.totalprice.toFixed(2) }}€
                    </template>
                    <template v-else-if="this.totalprice == 0">
                    0.00€
                    </template>
                    <template v-else>
                    {{ cart.totalPrice.toFixed(2) }}€
                    </template>
                </a>
            </nav>
        </div>
    </div>
</template>

<script>
    import { bus } from '../main';
    export default {
        props : ['user','totalprice'],
        data(){
            return {
                logo: '/img/deliveboo-logo-white.svg',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                showMenu: false,
                cart:{
                    items:[],
                    totalPrice:0,
                    totalQty:0,
                }
            }
        },
        created() {
                bus.$on('passing-total-price', (payload) => {
                    this.totalprice = payload;
                });
        },
        mounted() {
            if (localStorage.getItem('carts')) {
                this.cart = JSON.parse(localStorage.getItem('carts'));
            }
        },
        methods: {
            submit: function(){
                this.$refs.form.submit();
            },
            toggleShow: function(){
                this.showMenu = !this.showMenu;
            }
        }
    }
</script>
