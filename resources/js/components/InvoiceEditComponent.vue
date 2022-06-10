<template>
    <div>
        <b-button size="sm" variant="warning" @click="showModal"> Editar </b-button>
        <b-button size="sm" variant="danger" @click="deleteInvoice"> Excluir </b-button>

        <b-modal ref="my-modal" hide-footer title="Using Component Methods">
        </b-modal>
    </div>
</template>

<script>
export default {
    props:['order'],
    data(){
        return{

        }
    },
    methods: {
      showModal() {
        this.$refs['my-modal'].show()
      },
      hideModal() {
        this.$refs['my-modal'].hide()
      },
      deleteInvoice(){

      },
      editInvoice(){

      }
    }
};
</script>

<style>
</style>