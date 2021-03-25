<template>

    <div class="container-list">
        <div class="container">
            <div class="dashboard-header">
                <h1>I MIEI RISTORANTI</h1>
                <div>
                    <a class="cta-button" :href="'/restaurants/create'">
                        <i class="fas fa-utensils"></i>
                        Crea il tuo ristorante
                    </a>
                </div>
            </div>
            <div class="restaurants-container my-restaurants dashboard-restaurants">
                <div v-for="restaurant in restaurants" :key="restaurant.id">
                    <div v-if="user.id == restaurant.user_id" class="card">
                        <div class="card-image" v-bind:style="{ backgroundImage: 'url(' + restaurant.imgUrl + ')' }">
                        </div>
                        <div class="card-content">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 class="restaurant-name">
                                        {{ restaurant.name }}
                                    </h2>
                                </div>
                                <div>
                                    <div>
                                        <a id="menu-btn" class="my-action" @click="toggleMenu(restaurant.id), addName(restaurant.name)">VEDI MENÙ</a>
                                        <a class="my-action" @click="close()">CHIUDI MENÙ</a>
                                    </div>
                                </div>
                                <div>
                                    <form id="app" action = "/menuitems/create" method =" post"> 
                                        <div>
                                            <input id="restaurantId" type="hidden" :value="showRestaurant(restaurant)" name="restaurantId">
                                        </div>
                                       <input class="my-action" type="submit" value="AGGIUNGI PIATTO">  
                                    </form>   
                                </div>
                                <div class="my-buttons">
                                    <a :href="'/restaurants/' + restaurant.id + '/edit'">Modifica</a>
                                    <button @click="axiosRequest(restaurant.id)"> Elimina </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h2  v-if="showMenu" class="restName"> {{ this.restName }} </h2>
            <div v-if="showMenu" class="menu-container">
                <div v-for="item in menuitems" :key="item.id">
                    <div v-if="id == item.restaurant_id && item.isDeleted == false" class="menu-item-card my-menu-item">
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
                            <div class="item-price">
                                <h4>
                                    {{ item.price.toFixed(2) }} €
                                </h4>
                            </div>
                        </div>
                        <div class="menu-item-my-buttons">
                            <a :href="'/menuitems/'+ item.id +'/edit'">Modifica</a>
                            <a :href="'/menuitems/' + item.id + '/toggle'">{{ item.isActive ? 'Disattiva' : 'Attiva' }}</a>
                            <a :href="'/menuitems/' + item.id + '/delete'">Elimina</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</template>

<script>

export default {
    props: ['restaurants', 'menuitems', 'user'],
    data() {
        return { 
            showMenu: false,
            id: '',
            restName: ''
        }
    },
    computed:{
        
    },
    methods: {
        addName(name){
            this.restName = name;
        },
        close(){
            this.showMenu = false;
        },
        toggleMenu(id){
            this.id = id;
            if(!this.showMenu){
                this.showMenu = true;
            }
        },
        showRestaurant(restaurant){
            return restaurant.id;
        },
        showItem(item){
            return item.id;
        },
        axiosRequest(id) {
            if(confirm('Confirm?')){
                axios.post(
                    "http://localhost:8000/api/destroy/",
                    {
                        "id":id,
                    },

                    {
                        headers: {
                        "Content-type": "application/json; charset=UTF-8",
                        }
                    }
                    )
                    .then(response => {
                        if(response.data == 1){
                            window.location.reload();
                        }
                    })
            }
            
        }

    }
}
</script>