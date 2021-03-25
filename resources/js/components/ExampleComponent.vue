<template>
    <div class="container">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo odit est iste sapiente ut omnis, nobis doloribus animi saepe ipsa. Maiores consectetur ut quasi magnam natus omnis amet reiciendis veritatis.
        <!-- <input placeholder="Cerca" v-model="query" type="text">
            <button @click="autoComplete()">CERCA</button>

            <div  v-for="item in restaurants" :key="item.id" class="restaurant-card">
                <h3 class="restaurant-title">Nome Ristorante: <a :href="'restaurants/' + item.id" >{{ item.name }}</a> </h3>
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
            </div> -->
    </div>
</template>


<script>
    export default {
        data(){
            return {
                query: '',
                restaurants: []
            }
        },
        methods: {
            autoComplete(){
                this.restaurants = [];
                    axios.get('/api/restaurants', {params: {query:this.query}}).then(response => {
                        this.restaurants = response.data;
                    });
            },
        },
    }
</script>
