<template>
        <div class="container-list">
            <div class="hero" :class="{ isSearch: search }">
                <h1>Comodo. Veloce. DeliveBoo.</h1>
                <h3>Ordina online dai tuoi ristoranti preferiti di Roma</h3>
                <div class="search-box" @click="stateName ='opan', searchName()">
                    <label :data-state="stateName" for="search">
                        <input type="text" @keydown.enter="searchName()" v-model="queryName"
                            placeholder="Search restaurant's name"/>
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </label>
                </div>
                <div class="types">
                    <ul class="types-list">
                        <li @click="state ='opan', setTypes(type.type), addClass(type.id)" v-for="type in types" :key="type.id">
                            <div class="type">
                                <img :src="'img/types/' + type.type + '.svg'" alt="">
                                {{ type.type }}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <transition name="fade">
                <div class="list" v-if="showInformation == true">
                    <div class="restaurants-container">
                        <div class="card" v-for="item in restaurants" :key="item.id">
                            <div class="card-image" v-bind:style="{ backgroundImage: 'url(' + item.imgUrl + ')' }">
                            </div>
                            <div class="card-content">
                                <div class="card-title">
                                    <h2 class="restaurant-name">{{ item.name }}</h2>
                                </div>
                                <div class="card-header">
                                    <div class="info">
                                        <div class="icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <p>{{item.address}}</p>
                                    </div>
                                    <div class="info">
                                        <div class="icon">
                                            <i class="fas fa-box"></i>
                                        </div>
                                        <p>Orari di consegna: {{item.deliveryHours}}</p>
                                    </div>
                                    <div class="info">
                                        <div class="icon">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <p>{{item.phone}}</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button @click="cartReset(item)" class="card-button"> <a :href="'restaurants/' + item.id">Menu</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
</template>

<script>
    export default {
        props:['types'],
        data() {
            return {
                query: [],
                queryName: '',
                selected: undefined,
                restaurants: [],
                showInformation: false,
                state: "close",
                stateName: "close",
                search: false,
                cart:{
                    items:[],
                    totalPrice:0,
                    totalQty:0,
                },
            }
        },
        mounted() {
            if (localStorage.getItem('carts')) {
                this.cart = JSON.parse(localStorage.getItem('carts'));
            }
        },
        methods: {
            setTypes(item){
                if(this.query.includes(item)){
                    for (let i = 0; i < this.query.length; i++) {
                        if(this.query[i] == item){
                            this.query.splice(i,1);
                        }
                    }
                } else {
                    this.query.push(item);
                }
                this.searchRestaurants();
                this.toggle();
            },
            addClass(id){
                $( "ul.types-list li:nth-child("+id+")").toggleClass("active");
            },
            cartReset(item){

                if(item.id!=this.cart.items[0].restaurant_id){
                    this.cart.items = [];
                    this.cart.totalPrice =0;
                    this.cart.totalQty=0;

                    const parsed = JSON.stringify(this.cart);
                    localStorage.setItem('carts', parsed);
                }

            },

            toggle() {
                this.search = true;
            },

            searchName(queryName = this.queryName) {
                if(this.queryName != ''){
                    this.restaurants = [];
                    this.query= [];
                    $( "ul.types-list li").removeClass("active");
                axios.get('/api/restaurants', {
                    params: {
                        queryName
                    }
                }).then(response => {
                    if(this.restaurants.length == 0){
                        this.restaurants = response.data;
                        this.showInformation = true;
                    } else {
                        this.restaurants.push(response.data[i]);
                    }
                });
                    this.toggle();
                }
            },

            searchRestaurants(query = this.query) {
                this.restaurants = [];
                this.queryName = '';
                if(this.query != ''){
                axios.get('/api/types', {
                    params: {
                        query
                    }
                }).then(response => {
                    if(this.restaurants.length == 0){
                        this.restaurants = response.data;
                        this.showInformation = true;
                    } else {
                        this.restaurants.push(response.data[i]);
                    }
                });
                    this.toggle();
                }
            },
        },
    }

</script>

<style lang="scss" scoped>
    .active {
        background-color: #5433FF;
        // border: 1px solid #5433FF;
        border-top: 0.5px solid rgba(255, 255, 255, 0.5);
        border-left: 0.5px solid rgba(255, 255, 255, 0.5);

    }
    .types {
        ul {
            list-style: none;
            margin-top: 20px;
            li {
                text-transform: uppercase;
                font-weight: 700;
                display: inline-block;
                border-top: 1px solid rgba(255, 255, 255, 0.5);
                border-left: 1px solid rgba(255, 255, 255, 0.5);
                box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
                border-radius: 10px;
                padding: 10px;
                margin: 0 5px;
                &:hover {
                    cursor: pointer;
                    border-top: 0.5px solid rgba(255, 255, 255, 0.5);
                    border-left: 0.5px solid rgba(255, 255, 255, 0.5);
                    background-color: rgba(84, 51, 255, 0.2);
                    box-shadow: 0 5px 15px rgba(84, 51, 255, .4);
                }
            }
        }
        .active{
                //   border:  1px solid #5433FF;
                  border-top: 0.5px solid rgba(255, 255, 255, 0.5);
                  border-left: 0.5px solid rgba(255, 255, 255, 0.5);
                  background-color: rgba(84, 51, 255, 0.5);
                  box-shadow: 0 5px 15px rgba(84, 51, 255, .9);
                }
    }
</style>
