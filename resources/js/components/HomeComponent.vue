<template>
    <div>
        <div v-for="item in restaurants" :key="item.id" class="restaurant-card">
            <h3 class="restaurant-title"><a :href="'restaurants/' + item.id" >{{ item.name }}</a> </h3>
            <img :src=" item.imgUrl " alt="">
            <p>Indirizzo: {{item.address}}  Città: {{item.city}}</p>
            <p>CloseDay: {{item.closeDay}}</p>
            <p>Phone: {{item.phone}}</p>
            <p>Info: {{item.shortDescription}}</p>
            <div>
                <h3>CuisineType:</h3>
                    <ul>
                        <li v-bind:key="cuisine.id" v-for="cuisine in item.cuisine_type">
                            <p>Type: {{cuisine.type}} </p>
                        </li>
                    </ul>
            </div>
            <div>
                <h3>MenuItems:</h3>
                <ul>
                    <li v-bind:key="menu.id" v-for="menu in item.menu_items">
                        <a href="" >{{ menu.name }}</a>
                        <p>Description: {{menu.description}} </p>
                        <p>Ingrediens: {{menu.ingrediens}} </p>
                        <p>Price: {{menu.price}}€ </p>
                    </li>
                </ul>
            </div>
        </div>
        <transition name="fade">
            <div class="list" v-if="showInformation == true">
                <div class="container restaurants-container">
                    <div id="card" class="restaurant-card" v-for="restaurant in restaurants" :key="restaurant.id">
                        <div class="card-image">
                            <img :src=" restaurant.imgUrl " alt="" />
                        </div>

                        <div class="card-content">
                            <header class="card-header">
                                <h2 class="restaurant-name"> Nome Ristorante: <a :href="'restaurants/' + restaurant.id">{{ restaurant.name }}</a></h2>

                                <address>
                                    <span class="icon-pin" aria-hidden="true"></span>
                                     {{restaurant.address}}
                                </address>

                                <span>CloseDay: {{restaurant.closeDay}}</span>

                                <span>Phone: {{restaurant.phone}}</span>
                            </header>

                            <ul class="card-stats">
                                <li>
                                    <span class="icon-cuisine" aria-hidden="true"></span>
                                    <strong>{{restaurant.cuisine_type.length}}</strong>
                                    Tipi di Cucina
                                </li>

                                <li>
                                    <span class="icon-menu" aria-hidden="true"></span>
                                    <strong>{{restaurant.menu_items.length}}</strong>
                                    Piatti
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                query: '',
                restaurants: [],
                showInformation: false,
                state: "close",
                search: false,
            }
        },
        methods: {

            searchRestaurants(query = this.query){
                this.restaurants = [];

                    axios.get('/api/restaurants', {params: {query}}).then(response => {
                        this.restaurants = response.data;
                        this.showInformation = true;
                    });
            },
            toggle() {
                this.search = true;
            },
        },
    }
</script>
