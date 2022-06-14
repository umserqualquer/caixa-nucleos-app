<template>
    <div class="container">


        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="text-center">
                    <h4 align="center" style="color: #283B70;">Lista de Faturas</h4>
                </div>
                <table class="table table-sm tabble-striped table-bordered table-responsive-sm pr-2 mr-2">
                    <thead>
                        <tr class="text-center">
                            <th >#</th>
                            <th >Detalhes</th>
                            <th  colspan="2">A pagar</th>
                            <th  colspan="2">A receber</th>
                            <th>Vencimento</th>
                            <th>Total</th>
                            <th ><invoice-create-component @restart-invoice="getOrders()"></invoice-create-component></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr class="text-center">
                            <th scope="row">#<a href="">0000</a></th>
                            <td><small>Conta de Água</small></td>
                            <td><strong>João de Barros</strong></td>
                            <td>047.903.730-29</td>
                            <td><strong>Cagece</strong></td>
                            <td>48.957.578/0001-67</td>
                            <td>2022/06/13</td>
                            <td>2000</td>
                            <td>
                                <div>
                                    <invoice-edit-component></invoice-edit-component>
                                </div>
                            </td>
                        </tr> -->
                        
                        <tr class="text-center" v-for="order in orders" :key="order">
                            <th scope="row">#<a href="">{{ order.id }}</a></th>
                            <td><small>{{ order.title }}</small></td>
                            <td><strong>{{ order.payer_name }}</strong></td>
                            <td>{{ order.payer }}</td>
                            <td><strong>{{ order.receiver_name }}</strong></td>
                            <td>{{ order.receiver }}</td>
                            <td>{{ order.due_date }}</td>
                            <td>{{ formatReal(order.total) }}</td>
                            <td>
                                <div>
                                    <invoice-edit-component :order="order" @restart-invoice="getOrders()"></invoice-edit-component>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            orders: []
        }
    },
    created(){
        console.log('teste')
        this.getOrders()
    },
    methods: {
        getOrders(){

            console.log('entrou no getorders')

            axios.get("order").then((response) => {
                if (response.status == 200) {
                    this.orders = response.data;

                    console.log(response.data.orders)
                }
            });

        },
        formatReal(int){
        var tmp = int+'';
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
        if( tmp.length > 6 )
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

        return 'R$ ' + tmp;
        },
        

    }
};
</script>

<style>
</style>