<template>
    <div>
        <b-button size="sm" variant="primary" @click="showModal"> Criar Fatura </b-button>

        <b-modal ref="my-modal" hide-footer title="Gerar Fatura">

            <div v-if="errors" class="bg-danger text-white py-2 px-4 pr-0 rounded font-bold mb-4 shadow-lg">
                <div>
                    <p class="text-sm">
                        {{ errors.message }}
                    </p>
                </div>
            </div>

            <label><strong>Nome do Pagador:</strong></label>
            <b-form-input class="mb-1" v-model="req.name_payer"></b-form-input>
            <label><strong>Valor:</strong></label>
            <b-form-input class="mb-1" v-model="req.value"></b-form-input>
            <label><strong>Detalhes:</strong></label>
            <b-form-input class="mb-1" v-model="req.title"></b-form-input>
            <label><strong>Cpf ou Cnpj:</strong></label>
            <select class="custom-select" v-model="req.selected">
                <option value="cpf">CPF</option>
                <option value="cnpj">CNPJ</option>
            </select>
            <label v-if="selected == 'cpf'"><strong>Cpf:</strong></label>
            <b-form-input v-if="req.selected == 'cpf'" class="mb-1" type="cpf" v-model="req.cpf"></b-form-input>
            <label v-if="selected == 'cnpj'"><strong>Cnpj:</strong></label>
            <b-form-input v-if="req.selected == 'cnpj'" class="mb-1" type="cnpj" v-model="req.cnpj"></b-form-input>
            <label><strong>Data de Vencimento:</strong></label>
            <b-form-datepicker v-model="req.due_date"></b-form-datepicker>
            <!-- <div class="d-grid gap-2 mt-2"> -->
            <b-row class="mt-2">
                <b-col>
                    <b-button block variant="outline-success" @click="createInvoice">Submit</b-button>
                </b-col>
                <b-col>
                    <b-button block variant="outline-danger" @click="hideModal">Close</b-button>
                </b-col>
            </b-row>
            <!-- </div> -->
        </b-modal>
    </div>
</template>

<script>
export default {
    props: ["order"],
    data() {
        const now = new Date()
        const today = new Date(now.getFullYear(), now.getMonth(), now.getDate())

        return {
            errors: null,
            selected: "cpf",
            req: {
                id: null,
                title: "",
                name_payer: "",
                payer: "",
                name_receiver: "",
                receiver: "",
                due_date: today,
                cpf: null,
                cnpj: null,
                selected: "cpf",
            }
        }
    },
    methods: {
        showModal() {
            this.$refs["my-modal"].show()
        },
        hideModal() {
            this.$refs["my-modal"].hide()
        },
        createInvoice() {
            console.log("req form", this.req)

            axios
                .post("order", this.req)
                .then((response) => {
                    if (response.status == 200) {
                        this.$emit("restart-invoice")
                        this.hideModal()
                        console.log("Order Delete Post: ", response.data)
                    }
                })
                .catch((e) => {
                    console.log("ERRO:", e.response.data)
                    this.errors = e.response.data
                })
        }
    }
}
</script>

<style>
</style>