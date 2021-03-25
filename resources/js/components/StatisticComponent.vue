<template>
<div>
    <h1>INCASSO DI TUTTE LE ATTIVITA' DELL'UTENTE LOGGATO</h1>
    <line-chart :data="chart"
                width="600px" height="400px"
                ytitle="Incasso"
                prefix="€"
                thousands="."
                :messages="{empty: 'No data'}"
                :download="true"
                downloads="incassi_mensili_totali"
                
    ></line-chart>


    <table>
        <tr>
           <th>#</th> 
           <th>Cliente</th> 
           <th>Contatti</th> 
           <th>Data Creazione Ordine</th> 
           <th>Prezzo Finale</th> 
           <th>Pagamento</th> 
           <th>Data Pagamento Ordine</th> 
        </tr>
        <tr v-for="order in orders" :key="order.id">
            <td>{{order.id}}</td>
            <td>{{order.name}}  {{order.surname}}</td>
            <td>
                <p>{{order.phone}}</p>
                <p>{{order.email}}</p>
            </td>
            <td>{{order.orderCreate}}</td>
            <td>{{order.totalPrice}}</td>
            <td>{{order.isPayed}}</td>
            <td>{{order.orderPayed}}</td>
        </tr>
    </table>
</div>
    
</template>

<script>
export default {
    props : ['chart','orders'],
}
</script>

<style>
    .flex-column-td {
        display: flex;
        flex-direction:column;
    }
</style>