<template>
    <div>
        <b-button size="sm" variant="warning" @click="showModal"> Editar </b-button>
        <b-button size="sm" variant="danger" @click="deleteInvoice"> Excluir </b-button>

        <b-modal ref="my-modal" hide-footer title="Editar Fatura"> 

		</b-modal>
    </div>
</template>

<script>
export default {
    props: ["order"],
    data() {
        return {}
    },
    methods: {
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
                    .post("order", this.req)
                    .then((response) => {
                        if (response.status == 200) {
                            this.$emit("restart-invoice")
                            console.log("Order Delete Post: ", response.data)
                        }
                    })
                    .catch((e) => {
                        this.errors = e.data.errors
                    })
            }
        },
        editInvoice() {
            console.log("req form", this.req)

            axios
            	.post("order", this.req)
                .then((response) => {
                	if (response.status == 200) {
                        this.$emit("restart-invoice")
                        console.log("Order Delete Post: ", response.data)
                    }
                })
                .catch((e) => {
                    this.errors = e.data.errors
                })

        }
    }
}
</script>

<style>
</style>