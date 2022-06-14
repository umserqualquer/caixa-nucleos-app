<template>
    <div>
        <b-button size="sm" variant="warning" @click="showModal"> Editar </b-button>
        <b-button size="sm" variant="danger" @click="deleteInvoice"> Excluir </b-button>

        <b-modal ref="my-modal" hide-footer title="Editar Fatura"> 

            <div v-if="errors" class="bg-danger text-white py-2 px-4 pr-0 rounded font-bold mb-4 shadow-lg">
                <div>
                    <p class="text-sm">
                        {{ errors.message }}
                    </p>
                </div>
            </div>

            <label><strong>Nome do Pagador:</strong></label>
            <b-form-input class="mb-1" v-model="req.payer_name"></b-form-input>
            <label><strong>Valor:</strong></label>
            <b-form-input class="mb-1" v-model="req.total"></b-form-input>
            <label><strong>Detalhes:</strong></label>
            <b-form-input class="mb-1" v-model="req.title"></b-form-input>
            <label><strong>Cpf ou Cnpj:</strong></label>
            <select class="custom-select" v-model="req.selected">
                <option value="cpf">CPF</option>
                <option value="cnpj">CNPJ</option>
            </select>
            <label v-if="req.selected == 'cpf'"><strong>Cpf:</strong></label>
            <b-form-input v-if="req.selected == 'cpf'" class="mb-1" type="cpf" v-model="req.cpf"></b-form-input>
            <label v-if="req.selected == 'cnpj'"><strong>Cnpj:</strong></label>
            <b-form-input v-if="req.selected == 'cnpj'" class="mb-1" type="cnpj" v-model="req.cnpj"></b-form-input>
            <label><strong>Data de Vencimento:</strong></label>
            <b-form-datepicker v-model="req.due_date"></b-form-datepicker>

            <b-row class="mt-2">
                <b-col>
                    <b-button block variant="outline-success" @click="editInvoice">Submit</b-button>
                </b-col>
                <b-col>
                    <b-button block variant="outline-danger" @click="hideModal">Close</b-button>
                </b-col>
            </b-row>

		</b-modal>
    </div>
</template>

<script>
export default {
    props: ["order"],
    data() {
        return {
            errors: null,
            req: {
                id: null,
                title: "",
                payer_name: "",
                payer: "",
                due_date: null,
                cpf: null,
                cnpj: null,
                selected: 'cpf',
                total: null
            }
        }
    },
    created(){
        this.getData()
    },
    methods: {
        getData(){
            this.req = this.order

            if(this.order.receiver.length == 11){
                this.req.selected = 'cpf'
                this.req.cpf = this.order.payer
                console.log('entrou no cpf')
            }else{
                this.req.selected = 'cnpj'
                this.req.cnpj = this.order.payer
                console.log('entrou no cnpj')

            }

            console.log('getData', this.req)
        },
        showModal() {
            this.$refs["my-modal"].show()
        },
        hideModal() {
            this.$refs["my-modal"].hide()
        },
        deleteInvoice() {
            console.log("req form", this.req)

            if (confirm("Você realmente deseja excluir?")) {
                axios
                    .delete("order/"+this.order.id)
                    .then((response) => {
                        if (response.status == 200) {
                            this.$emit("restart-invoice")
                            console.log("Order Delete Post: ", response.data)
                        }
                    })
                    .catch((e) => {
                        this.errors = e.response.data

                    })
            }
        },
        editInvoice() {
            console.log("req form", this.req)

            axios
            	.put("order/"+this.order.id, this.req)
                .then((response) => {
                	if (response.status == 200) {
                        this.$emit("restart-invoice")
                        console.log("Order Delete Post: ", response.data)
                    }
                })
                .catch((e) => {
                    this.errors = e.response.data

                })

        }
    }
}
</script>

<style>
</style>